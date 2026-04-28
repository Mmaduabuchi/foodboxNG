<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class paymenthistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Base query for this user
        $baseQuery = $user->payments();

        // Count per status (always from unfiltered base)
        $totalPayments    = (clone $baseQuery)->count();
        $successPayments  = (clone $baseQuery)->successful()->count();
        $pendingPayments  = (clone $baseQuery)->pending()->count();
        $failedPayments   = (clone $baseQuery)->failed()->count();

        // Search & status filter
        $search       = $request->query('search');
        $statusFilter = $request->query('status');

        $filteredQuery = (clone $baseQuery)->with(['order', 'subscription'])->latest('created_at');

        if ($statusFilter && in_array($statusFilter, ['success', 'pending', 'failed', 'refunded'])) {
            $filteredQuery->where('status', $statusFilter);
        }

        if ($search) {
            $filteredQuery->where(function ($q) use ($search) {
                $q->where('transaction_reference', 'like', "%{$search}%")
                  ->orWhere('gateway_reference', 'like', "%{$search}%")
                  ->orWhere('payment_method', 'like', "%{$search}%")
                  ->orWhere('gateway', 'like', "%{$search}%");
            });
        }

        $payments = $filteredQuery->paginate(10)->withQueryString();

        return view('dashboard.payment_history', compact(
            'user',
            'payments',
            'totalPayments',
            'successPayments',
            'pendingPayments',
            'failedPayments',
            'statusFilter',
            'search'
        ));
    }
}
