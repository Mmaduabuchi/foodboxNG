<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Subscription;
use App\Models\Package;

class adminHomeController extends Controller
{
    //
    public function index(){
        // Authenticated admin name
        $adminName = Auth::user()->name;

        // Total users
        $totalUsers = User::where('role', 'user')->count();

        // Total orders
        $totalOrders = Order::count();

        // Total active subscriptions
        $activeSubscriptions = Subscription::active()->count();

        // Recent orders (latest 5) with relationships
        $recentOrders = Order::with(['user', 'package'])
            ->latest()
            ->take(5)
            ->get();

        // Top 3 active packages by subscription count
        $topPackages = Package::withCount('subscriptions')
            ->active()
            ->orderBy('subscriptions_count', 'desc')
            ->take(3)
            ->get();

        // Recent 5 registered users
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('superAdminDashboard.home', compact(
            'adminName',
            'totalUsers',
            'totalOrders',
            'activeSubscriptions',
            'recentOrders',
            'topPackages',
            'recentUsers'
        ));
    }

    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('secure')->with('success', 'Logged out successfully');
    }
}
