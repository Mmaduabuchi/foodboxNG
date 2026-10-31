<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\FlutterwaveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class checkoutController extends Controller
{
    public function initializePayment(Request $request, FlutterwaveService $flutterwave) {
        // Validate checkout information.
        $validated = $request->validate([
            'address_id' => ['required', 'integer'],
            'delivery_method' => ['required', 'in:standard,express'],
            'delivery_date' => ['required', 'date', 'after_or_equal:today'],
            'delivery_time_slot' => [
                'required',
                'in:morning,afternoon,evening'
            ],
            'delivery_instructions' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = Auth::user();

        // Confirm that the selected address belongs to this user.
        $address = Address::where('user_id', $user->id)
            ->findOrFail($validated['address_id']);

        // Retrieve the user's active cart.
        $cart = Cart::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('items.subPackage.package')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.',
            ], 422);
        }

        foreach ($cart->items as $item) {
            $subPackage = $item->subPackage;

            if (!$subPackage || $subPackage->status !== 'active' || !$subPackage->is_available) {
                return response()->json([
                    'success' => false,
                    'message' => 'One or more packages are no longer available.',
                ], 422);
            }

            if ((float) $item->unit_price !== (float) $subPackage->price) {
                return response()->json([
                    'success' => false,
                    'message' => 'A package price has changed. Please review your cart.',
                ], 422);
            }
        }

        // Calculate all amounts using server-side values.
        $subtotal = $cart->items->sum(
            fn ($item) => (float) $item->subPackage->price * $item->quantity
        );

        $shippingFee = $validated['delivery_method'] === 'express'
            ? 2000
            : 0;

        $discount = 0;

        $total = $subtotal + $shippingFee - $discount;

        // Convert selected time slot into database times.
        $timeSlots = [
            'morning' => ['08:00:00', '12:00:00'],
            'afternoon' => ['12:00:00', '16:00:00'],
            'evening' => ['16:00:00', '20:00:00'],
        ];

        [$startTime, $endTime] = $timeSlots[
            $validated['delivery_time_slot']
        ];

        // Create the pending order and order items.
        $order = DB::transaction(function () use (
            $user,
            $cart,
            $address,
            $validated,
            $subtotal,
            $shippingFee,
            $discount,
            $total,
            $startTime,
            $endTime
        ) {
            $reference = 'FBNG-' . Str::upper(Str::random(12));

            $order = Order::create([
                'user_id' => $user->id,
                'package_id' => null,
                'subscription_id' => null,
                'address_id' => $address->id,

                'package_name' => 'FoodBox NG Order',
                'order_reference' => $reference,

                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'discount' => $discount,
                'amount' => $total,

                'status' => Order::STATUS_PENDING,
                'payment_method' => 'flutterwave',

                'delivery_method' => $validated['delivery_method'],
                'delivery_instructions' => $validated['delivery_instructions'] ?? null,

                'scheduled_date' => $validated['delivery_date'],
                'delivery_start_time' => $startTime,
                'delivery_end_time' => $endTime,
                'delivery_status' => Order::DELIVERY_PENDING,
            ]);

            foreach ($cart->items as $item) {
                $unitPrice = (float) $item->subPackage->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'sub_package_id' => $item->sub_package_id,
                    'package_name' => $item->subPackage->package->name ?? $item->subPackage->name,
                    'subpackage_name' => $item->subPackage->name,
                    'purchase_type' => $item->purchase_type,
                    'quantity' => $item->quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $unitPrice * $item->quantity,
                ]);
            }

            return $order;
        });

        // Initialize Flutterwave payment.
        try {
            $payment = $flutterwave->createPayment([
                'tx_ref' => $order->order_reference,
                'amount' => number_format((float) $order->amount, 2, '.', ''),
                'currency' => 'NGN',

                'redirect_url' => route('checkout.callback'),

                'customer' => [
                    'email' => $user->email,
                    'name' => $address->recipient_name,
                    'phonenumber' => $address->phone,
                ],

                'customizations' => [
                    'title' => 'FoodBox NG',
                    'description' => 'Payment for your FoodBox NG order',
                ],

                'meta' => [
                    'order_id' => $order->id,
                ],
            ]);

            return response()->json([
                'success' => true,
                'payment_link' => $payment['link'],
            ]);

        } catch (Throwable $e) {
            report($e);

            $order->update([
                'status' => Order::STATUS_FAILED,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to initialize payment. Please try again.',
            ], 500);
        }
    }



    public function callback(Request $request, FlutterwaveService $flutterwave)
    {
        $transactionId = $request->query('transaction_id');
        $transactionStatus = $request->query('status');
        $txRef = $request->query('tx_ref');

        if (!$transactionId || !$txRef) {
            return redirect()->route('carts')
                ->with('error', 'Invalid payment response.');
        }

        $order = Order::where('order_reference', $txRef)->first();

        if (!$order) {
            return redirect()->route('carts')
                ->with('error', 'Order not found.');
        }

        // Prevent processing an already completed order again.
        if ($order->status === Order::STATUS_COMPLETED) {
            return redirect()->route('carts')
                ->with('success', 'Your payment has already been confirmed.');
        }

        if ($transactionStatus !== 'successful') {
            $order->update([
                'status' => Order::STATUS_FAILED,
            ]);

            \Log::info('FoodBox Flutterwave Callback', [
                'transaction_id' => $transactionId,
                'status' => $transactionStatus,
                'tx_ref' => $txRef,
                'all_parameters' => $request->query(),
            ]);

            return redirect()->route('carts')
                ->with('error', 'Your payment was not successful.');
        }

        try {
            $payment = $flutterwave->verifyPayment($transactionId);

            $isValid =
                ($payment['status'] ?? null) === 'successful' &&
                ($payment['tx_ref'] ?? null) === $order->order_reference &&
                ($payment['currency'] ?? null) === 'NGN' &&
                (float) ($payment['amount'] ?? 0) >= (float) $order->amount;

            if (!$isValid) {
                $order->update([
                    'status' => Order::STATUS_FAILED,
                ]);

                return redirect()->route('carts')
                    ->with('error', 'Payment verification failed.');
            }

            DB::transaction(function () use ($order, $transactionId) {
                $lockedOrder = Order::whereKey($order->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($lockedOrder->status === Order::STATUS_COMPLETED) {
                    return;
                }

                $lockedOrder->update([
                    'status' => Order::STATUS_COMPLETED,
                    'transaction_id' => $transactionId,
                ]);

                // Clear the customer's cart only after verified payment.
                Cart::where('user_id', $lockedOrder->user_id)
                    ->where('status', 'active')
                    ->first()
                    ?->items()
                    ->delete();
            });

            return redirect()->route('carts')
                ->with('success', 'Payment successful! Your order has been confirmed.');

        } catch (Throwable $e) {
            report($e);

            return redirect()->route('carts')
                ->with('error', 'We could not verify your payment. Please contact support if you were charged.');
        }
    }
}
