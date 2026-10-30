<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\SubPackages;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class cartsController extends Controller
{
    //Get or create the current cart.
    private function currentCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'active',
                ],
                [
                    'session_id' => null,
                ]
            );
        }

        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
            'user_id' => null,
            'status' => 'active',
        ]);

        session(['guest_cart_id' => $cart->id]);

        return $cart;

    }

    public function index() {
        $cart = $this->currentCart();

        $cart->load([
            'items.subPackage.package',
            'items.subPackage.items',
        ]);

        $subtotal = $cart->items->sum(
            fn ($item) => (float) $item->unit_price * $item->quantity
        );

        $itemCount = $cart->items->sum('quantity');

        // IDs of sub-packages and parent packages currently in the cart
        $inCartSubPackageIds = $cart->items->pluck('sub_package_id')->filter()->unique()->toArray();
        $inCartPackageIds = $cart->items->pluck('subPackage.package_id')->filter()->unique()->toArray();

        // Base query for active and available sub-packages
        $baseQuery = SubPackages::active()
            ->available()
            ->with(['package', 'items']);

        // First, look for sub-packages not yet in the cart
        $candidates = (clone $baseQuery)
            ->whereNotIn('id', $inCartSubPackageIds)
            ->get();

        if ($candidates->isNotEmpty()) {
            // Prioritize items sharing the same parent package with items in the cart
            $relatedSubPackages = $candidates->sortByDesc(function ($sub) use ($inCartPackageIds) {
                return in_array($sub->package_id, $inCartPackageIds) ? 1 : 0;
            })->take(4)->values();
        } else {
            // Fallback: if all active sub-packages are in the cart, show available sub-packages
            $relatedSubPackages = $baseQuery->take(4)->get();
        }

        return view('carts', compact(
            'cart',
            'subtotal',
            'itemCount',
            'relatedSubPackages'
        ));
    }

    public function delivery_cart() {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to continue checkout.');
        }

        $user = Auth::user();
        $addresses = Address::where('user_id', Auth::id())->get();

        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->with([
                'items.subPackage.package',
                'items.subPackage.items',
            ])
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('carts')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = $cart->items->sum(
            fn ($item) =>
                (float) $item->unit_price * $item->quantity
        );

        return view('cart_delivery', compact(
            'user',
            'addresses',
            'cart',
            'subtotal'
        ));
    }


    public function store(Request $request) {
        $validated = $request->validate([
            'sub_package_id' => ['required', 'integer'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
            'purchase_type' => ['nullable', 'in:one_time,monthly'],
        ]);

        $quantity = (int) ($validated['quantity'] ?? 1);
        $purchaseType = $validated['purchase_type'] ?? 'one_time';

        // Only allow active and available sub-packages.
        $subPackage = SubPackages::active()
            ->available()
            ->whereKey($validated['sub_package_id'])
            ->first();

        if (!$subPackage) {
            return back()->with('error', 'This package is currently unavailable.');
        }

        // Save the cart item using the current server-side price.
        DB::transaction(function () use (
            $subPackage,
            $quantity,
            $purchaseType
        ) {
            $cart = $this->currentCart();

            $item = CartItem::where('cart_id', $cart->id)
                ->where('sub_package_id', $subPackage->id)
                ->where('purchase_type', $purchaseType)
                ->lockForUpdate()
                ->first();

            if ($item) {
                $item->quantity = min(99, $item->quantity + $quantity);
                $item->unit_price = $subPackage->price;
                $item->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'sub_package_id' => $subPackage->id,
                    'purchase_type' => $purchaseType,
                    'quantity' => $quantity,
                    'unit_price' => $subPackage->price,
                ]);
            }
        });

        return back()->with('success', 'Package added to cart.');
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = $this->currentCart();
        $item = CartItem::where('cart_id', $cart->id)->where('id', $id)->firstOrFail();
        $item->quantity = $validated['quantity'];
        $item->save();

        if ($request->wantsJson() || $request->ajax()) {
            $cart->load('items');
            $subtotal = $cart->items->sum(fn ($i) => (float) $i->unit_price * $i->quantity);
            $itemCount = $cart->items->sum('quantity');
            return response()->json([
                'success' => true,
                'quantity' => $item->quantity,
                'item_total' => (float) $item->unit_price * $item->quantity,
                'subtotal' => $subtotal,
                'itemCount' => $itemCount,
            ]);
        }

        return back()->with('success', 'Cart updated successfully.');
    }

    public function destroy(Request $request, $id) {
        $cart = $this->currentCart();
        $item = CartItem::where('cart_id', $cart->id)->where('id', $id)->firstOrFail();
        $item->delete();

        if ($request->wantsJson() || $request->ajax()) {
            $cart->load('items');
            $subtotal = $cart->items->sum(fn ($i) => (float) $i->unit_price * $i->quantity);
            $itemCount = $cart->items->sum('quantity');
            return response()->json([
                'success' => true,
                'subtotal' => $subtotal,
                'itemCount' => $itemCount,
                'isEmpty' => $cart->items->isEmpty(),
            ]);
        }

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear(Request $request) {
        $cart = $this->currentCart();
        CartItem::where('cart_id', $cart->id)->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'isEmpty' => true,
            ]);
        }

        return back()->with('success', 'Cart cleared successfully.');
    }
}
