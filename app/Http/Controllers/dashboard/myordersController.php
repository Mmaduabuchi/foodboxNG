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
    public function index(Request $request){
        $user = Auth::user();

        // Safety check
        if (!$user) {
            return redirect()->route('login');
        }

        // Base query
        $ordersQuery = $user->orders();

        // Get order counts (always from full unfiltered base)
        $pendingOrders   = (clone $ordersQuery)->pending()->count();
        $completedOrders = (clone $ordersQuery)->completed()->count();
        $cancelledOrders = (clone $ordersQuery)->cancelled()->count();
        $totalOrders     = (clone $ordersQuery)->count();

        // Active order (regardless of filter)
        $activeOrder = (clone $ordersQuery)->active()->latest()->first();

        // Apply status filter from query string
        $statusFilter = $request->query('status');
        $filteredQuery = (clone $ordersQuery)->with('package')->latest();

        if ($statusFilter === 'pending') {
            $filteredQuery->pending();
        } elseif ($statusFilter === 'completed') {
            $filteredQuery->completed();
        } elseif ($statusFilter === 'cancelled') {
            $filteredQuery->cancelled();
        }

        // Paginate (appends query string to pagination links automatically)
        $orders = $filteredQuery->paginate(10)->withQueryString();

        return view('dashboard.myorders', compact(
            'user',
            'activeOrder',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalOrders',
            'orders',
            'statusFilter'
        ));
    }
}
