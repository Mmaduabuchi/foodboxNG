<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminInactiveSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Only check authenticated users
        if (!$user) {
            return $next($request);
        }

        // 5 minutes = 300 seconds
        $timeout = 300;

        $lastActivity = $request->session()->get('admin_last_activity');

        // Check if admin has been inactive too long
        if (
            $lastActivity &&
            (now()->timestamp - $lastActivity) > $timeout
        ) {

            Log::warning('Admin session expired due to inactivity', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('secure')
                ->with(
                    'error',
                    'Your admin session expired due to inactivity. Please login again.'
                );
        }

        // Update admin activity timestamp
        $request->session()->put(
            'admin_last_activity',
            now()->timestamp
        );

        return $next($request);
    }
}