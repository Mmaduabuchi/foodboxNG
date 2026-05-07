<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Order;

use Carbon\Carbon;

class subscriptionManagementController extends Controller
{
    public function index(Request $request)
    {
        // Authenticated admin name
        $adminName = Auth::user()->name;

        // Summary counts for stat cards (always unfiltered)
        $activeSubscriptions   = Subscription::active()->count();
        $inactiveSubscriptions = Subscription::pending()->count();
        $draftSubscriptions    = Subscription::cancelled()->count();

        $activeThisWeek = Subscription::active()
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();

        //Filterable query
        $query = Subscription::with(['user', 'package'])->latest();

        $expiringNext7Days = Subscription::whereBetween('next_renewal_date', [
            Carbon::today(),
            Carbon::today()->addDays(7)
        ])->count();

        $failedRenewals = Subscription::failed()->count();

        $annualRevenue = Order::completed()
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $lastYearRevenue = Order::completed()
            ->whereYear('created_at', now()->subYear()->year)
            ->sum('amount');

        $revenueGrowth = ($lastYearRevenue > 0) 
            ? (($annualRevenue - $lastYearRevenue) / $lastYearRevenue) * 100 
            : ($annualRevenue > 0 ? 100 : 0);

        //Search by customer name or email
        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        //Status filter
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Renewal date filter
        if ($renewalDate = $request->input('renewal_date')) {
            $query->whereDate('next_renewal_date', $renewalDate);
        }

        $subscriptions = $query->paginate(15)->appends(
            $request->only(['search', 'status', 'renewal_date'])
        );

        return view('superAdminDashboard.subscriptionsManagement', compact(
            'adminName',
            'activeSubscriptions',
            'inactiveSubscriptions',
            'draftSubscriptions',
            'activeThisWeek',
            'expiringNext7Days',
            'subscriptions',
            'failedRenewals',
            'annualRevenue',
            'revenueGrowth',
        ));
    }
}
