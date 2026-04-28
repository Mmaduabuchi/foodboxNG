<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class managesubscriptionController extends Controller
{
    //
    public function index(){
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Fetch subscriptions with package info
        $subscriptions = $user->subscriptions()
            ->with('package')
            ->latest()
            ->paginate(10);

        // Active subscription
        $activeSubscription = $user->subscriptions()
            ->active()
            ->with('package')
            ->first();

        return view('dashboard.manage_subscription', compact(
            'user',
            'subscriptions',
            'activeSubscription'
        ));
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'delivery_frequency' => 'required|string',
            'delivery_zone' => 'required|string',
            'delivery_window' => 'nullable|string',
            'special_notes' => 'nullable|string',
        ]);

        $subscription = $user->subscriptions()
            ->active()
            ->first();

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found'], 404);
        }

        $subscription->update([
            'delivery_frequency' => $request->delivery_frequency,
            'delivery_zone' => $request->delivery_zone,
            'delivery_window' => $request->delivery_window,
            'special_notes' => $request->special_notes,
        ]);

        return response()->json([
            'message' => 'Subscription preferences updated successfully',
            'subscription' => $subscription
        ]);
    }
}
