<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Subscription;

class homeController extends Controller
{
    //
    public function index() {
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

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

        //fetch users suscriptions
        $subscriptions = $user->subscriptions();

        $activeSubscription = (clone $subscriptions)
            ->active()
            ->with('package') // important
            ->latest()
            ->first();

        $nextDelivery = (clone $subscriptions)
            ->with('package')
            ->active()
            ->orderBy('next_renewal_date')
            ->first();

        $activeSubscriptions = (clone $subscriptions)->active()->count();
        $pendingSubscriptions = (clone $subscriptions)->pending()->count();
        $cancelledSubscriptions = (clone $subscriptions)->cancelled()->count();
        $totalSubscriptions = (clone $subscriptions)->count();
        
        return view('dashboard.home', compact(
            'user',
            'activeOrder',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalOrders',
            'activeSubscriptions',
            'pendingSubscriptions',
            'cancelledSubscriptions',
            'totalSubscriptions',
            'activeSubscription',
            'recentOrders',
            'nextDelivery'
        ));
    }
}
