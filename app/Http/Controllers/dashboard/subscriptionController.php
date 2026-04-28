<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class subscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Fetch all subscriptions, eager-loading the package
        $allSubscriptions = Subscription::where('user_id', $user->id)
            ->with('package')
            ->latest()
            ->get();

        // Split into active vs paused/cancelled
        $activeSubscriptions   = $allSubscriptions->where('status', 'active');
        $inactiveSubscriptions = $allSubscriptions->whereIn('status', ['paused', 'cancelled']);

        return view('dashboard.subscriptions', compact(
            'user',
            'activeSubscriptions',
            'inactiveSubscriptions'
        ));
    }
}
