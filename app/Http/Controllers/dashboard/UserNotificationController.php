<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Log;

class UserNotificationController extends Controller
{
    public function markAllRead(Request $request)
    {
        try {
            $user = Auth::user();

            UserNotification::where('user_id', $user->id)
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now(),
                ]);

            $unreadCount = UserNotification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();

            return response()->json([
                'success' => true,
                'message' => 'All notifications marked as read',
                'unread_count' => $unreadCount,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to mark notifications as read.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Unable to update notifications. Please try again.',
            ], 500);
        }
    }
}
