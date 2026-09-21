<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SingleDeviceSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Make sure the user is authenticated
        if (!$user) {
            return $next($request);
        }

        $sessionId = $request->session()->get('active_session_id');

        // If the session ID stored in the browser
        // does not match the user's active session ID,
        // another device has logged in.
        if (!$sessionId || $sessionId !== $user->active_session_id) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Your account was signed in on another device. Please login again.'
                );
        }

        return $next($request);
    }
}