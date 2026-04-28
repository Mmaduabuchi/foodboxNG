<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Package;

class mypackagesController extends Controller
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
            ->paginate(10);

        return view('dashboard.mypackages', compact(
            'user',
            'recentOrders',
            'activeOrder',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalOrders'
        ));
    }
}
