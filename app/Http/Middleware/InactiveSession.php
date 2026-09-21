<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InactiveSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Only check authenticated users
        if (!$user) {
            return $next($request);
        }

        // 10 minutes = 600 seconds
        $timeout = 600;

        $lastActivity = $request->session()->get('last_activity');

        // Check if the session has been inactive too long
        if (
            $lastActivity &&
            (now()->timestamp - $lastActivity) > $timeout
        ) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Your session expired due to inactivity. Please login again.'
                );
        }

        // Update the last activity timestamp
        $request->session()->put(
            'last_activity',
            now()->timestamp
        );

        return $next($request);
    }
}