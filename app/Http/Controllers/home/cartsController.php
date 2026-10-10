<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
            fn ($item) =>
                (float) $item->unit_price * $item->quantity
        );

        $itemCount = $cart->items->sum('quantity');

        return view('carts', compact(
            'cart',
            'subtotal',
            'itemCount'
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
}
