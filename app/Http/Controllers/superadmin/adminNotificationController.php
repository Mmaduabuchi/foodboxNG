<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Log;

class adminNotificationController extends Controller
{

    public function markAllAdminRead(Request $request)
    {
        try {
            //mark all unread admin notifications as read
            $updated = AdminNotification::where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now(),
                ]);

            return response()->json([
                'success' => true,
                'message' => $updated > 0
                    ? 'All notifications marked as read.'
                    : 'There are no unread notifications.',
                'updated_count' => $updated,
                'unread_count' => 0,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to mark notifications as read.', [
                'admin_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to update notifications. Please try again.',
            ], 500);
        }
    }
}
