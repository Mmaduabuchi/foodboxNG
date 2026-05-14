<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class paymentManagementController extends Controller
{
    public function index(Request $request)
    {
        $adminName = Auth::user()->name;

        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        //Gross Revenue (successful, this month)
        $grossRevenue = Payment::successful()
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $lastMonthRevenue = Payment::successful()
            ->whereBetween('paid_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('amount');

        $revenueMoM = $lastMonthRevenue > 0
            ? round((($grossRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : null;

        //Total Refunds (this month)
        $totalRefunds = Payment::refunded()
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        //Failed Transactions count & rate (this month)
        $failedCount = Payment::failed()
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        $totalThisMonth = Payment::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $failureRate = $totalThisMonth > 0
            ? round(($failedCount / $totalThisMonth) * 100, 1)
            : 0;

        //Average Transaction Value (successful, this month)
        $avgTransactionValue = Payment::successful()
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->avg('amount') ?? 0;

        // Read filter inputs
        $search = $request->input('search');
        $status = $request->input('status');
        $type = $request->input('type');

        // Transaction table — filtered, paginated, newest first
        $payments = Payment::with('user')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('transaction_reference', 'like', "%{$search}%")
                      ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"))
                      ->orWhere('amount', 'like', "%{$search}%");
                });
            })
            ->when($status, fn($q) => $q->where('status', strtolower($status)))
            ->when($type === 'subscription', fn($q) => $q->whereNotNull('subscription_id'))
            ->when($type === 'order', fn($q) => $q->whereNotNull('order_id')->whereNull('subscription_id'))
            ->when($type === 'wallet', fn($q) => $q->whereNull('subscription_id')->whereNull('order_id'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('superAdminDashboard.payments_transactions', compact(
            'adminName',
            'grossRevenue',
            'revenueMoM',
            'totalRefunds',
            'failedCount',
            'failureRate',
            'avgTransactionValue',
            'payments',
            'search',
            'status',
            'type',
        ));
    }
}
