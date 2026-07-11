<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;


class cartsController extends Controller
{
    //
    public function index() {
        return view('carts');
    }

    public function delivery_cart() {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $addresses = Address::where('user_id', Auth::id())->get();

        return view('cart_delivery', compact('addresses'));
    }
}
