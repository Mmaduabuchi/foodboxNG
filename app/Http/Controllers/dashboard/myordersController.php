<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class myordersController extends Controller
{
    //
    public function index(){
        $user = Auth::user();

        // Safety check
        if (!$user) {
            return redirect()->route('login');
        }

        // Single query approach
        $orders = $user->orders();

        $activeOrder = (clone $orders)
            ->active()
            ->latest()
            ->first();

        // Get order counts
        $pendingOrders = (clone $orders)->pending()->count();
        $completedOrders = (clone $orders)->completed()->count();
        $cancelledOrders = (clone $orders)->cancelled()->count();
        //total orders
        $totalOrders = (clone $orders)->count();

        $recentOrders = (clone $orders)
            ->with('package')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.myorders', compact(
            'user',
            'activeOrder',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalOrders',
            'recentOrders'
        ));
    }
}
