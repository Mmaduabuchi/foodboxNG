<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CartMergeService
{
    /**
     * Merge a guest cart into the authenticated user's cart.
     */
    public function merge(User $user): void
    {
        $guestCartId = session('guest_cart_id');

        // No guest cart to merge.
        if (!$guestCartId) {
            return;
        }

        DB::transaction(function () use ($user, $guestCartId) {

            // Find the guest's active cart.
            $guestCart = Cart::where('id', $guestCartId)
                ->whereNull('user_id')
                ->where('status', 'active')
                ->lockForUpdate()
                ->first();

            if (!$guestCart) {
                return;
            }

            // Find or create the user's active cart.
            $userCart = Cart::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'status' => 'active',
                ],
                [
                    'session_id' => null,
                ]
            );

            $userCart = Cart::whereKey($userCart->id)
                ->lockForUpdate()
                ->firstOrFail();

            $guestCart->load('items');

            foreach ($guestCart->items as $guestItem) {
                $existingItem = CartItem::where(
                    'cart_id',
                    $userCart->id
                )
                    ->where(
                        'sub_package_id',
                        $guestItem->sub_package_id
                    )
                    ->where(
                        'purchase_type',
                        $guestItem->purchase_type
                    )
                    ->lockForUpdate()
                    ->first();

                if ($existingItem) {
                    // Combine the quantities.
                    $existingItem->increment(
                        'quantity',
                        $guestItem->quantity
                    );

                    $guestItem->delete();
                } else {
                    // Move the guest item to the user's cart.
                    $guestItem->update([
                        'cart_id' => $userCart->id,
                    ]);
                }
            }

            // Remove the now-empty guest cart.
            $guestCart->delete();
        });

        // Clear the saved guest cart ID after success.
        session()->forget('guest_cart_id');
    }
}
