<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class orderManagementController extends Controller
{
    public function index(Request $request)
    {
        // Authenticated admin name
        $adminName = Auth::user()->name;

        // Summary counts for stat cards
        $totalOrders = Order::count();
        $pendingOrders = Order::pending()->count();
        $cancelledOrders = Order::cancelled()->count();
        // Delivery status counts
        $processingOrders = Order::deliveryProcessing()->count();

        $processingToday = Order::deliveryProcessing()
            ->whereDate('created_at', Carbon::today())->count();

        $cancelledThisMonth = Order::cancelled()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $cancelledLastMonth = Order::cancelled()
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $cancelledChange = $cancelledLastMonth > 0
            ? (($cancelledThisMonth - $cancelledLastMonth) / $cancelledLastMonth) * 100
            : ($cancelledThisMonth > 0 ? 100 : 0);

        // Filterable query
        $orders = Order::with(['user', 'package'])->latest();

        //Search by transaction_id or customer name
        if ($search = $request->input('search')) {
            $orders->where(function ($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        //Status filter
        if ($status = $request->input('status')) {
            $orders = match ($status) {
                'delivered' => $orders->delivered(),
                'processing' => $orders->deliveryProcessing(),
                'out_for_delivery' => $orders->outForDelivery(),
                'cancelled' => $orders->cancelled(),
                'pending' => $orders->pending(),
                default => $orders,
            };
        }

        //Date filter (orders placed on a specific date)
        if ($date = $request->input('date')) {
            $orders->whereDate('created_at', $date);
        }

        $orders = $orders->paginate(15)->appends($request->only(['search', 'status', 'date']));

        return view('superAdminDashboard.ordersManagement', compact(
            'adminName',
            'totalOrders',
            'processingOrders',
            'pendingOrders',
            'cancelledOrders',
            'processingToday',
            'cancelledChange',
            'cancelledThisMonth',
            'orders'
        ));
    }
}
