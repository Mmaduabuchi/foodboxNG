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

    public function pause(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'duration' => 'required|string',
        ]);

        $subscription = $user->subscriptions()->active()->first();

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found to pause'], 404);
        }

        $subscription->update([
            'status' => Subscription::STATUS_PAUSED,
            'paused_at' => now(),
            'pause_duration' => $request->duration,
        ]);

        return response()->json([
            'message' => 'Subscription paused successfully',
            'subscription' => $subscription
        ]);
    }

    public function cancel(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'reason' => 'required|string',
        ]);

        $subscription = $user->subscriptions()->whereIn('status', [Subscription::STATUS_ACTIVE, Subscription::STATUS_PAUSED])->first();

        if (!$subscription) {
            return response()->json(['message' => 'No active or paused subscription found to cancel'], 404);
        }

        $subscription->update([
            'status' => Subscription::STATUS_CANCELLED,
            'cancelled_at' => now(),
            'cancel_reason' => $request->reason,
        ]);

        return response()->json([
            'message' => 'Subscription cancelled successfully',
            'subscription' => $subscription
        ]);
    }

    public function updateFrequency(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'delivery_frequency' => 'required|string',
        ]);

        $subscription = $user->subscriptions()->active()->first();

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found'], 404);
        }

        $subscription->update([
            'delivery_frequency' => $request->delivery_frequency,
        ]);

        return response()->json([
            'message' => 'Delivery frequency updated successfully',
            'subscription' => $subscription
        ]);
    }
}
