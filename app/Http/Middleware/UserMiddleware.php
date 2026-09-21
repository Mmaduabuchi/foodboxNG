<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Safety check
        if (!$user) {
            return redirect()->route('login');
        }

        //Redirect Admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Check Deactivated Account
        if (!$user->is_active) {

            Log::warning('Deactivated user attempted authenticated request', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Your account has been deactivated. Please contact support.'
                );
        }


        // Check Suspended Account
        if ($user->is_suspended) {

            Log::warning('Suspended user attempted authenticated request', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Your account has been suspended. Please contact support.'
                );
        }
        
        return $next($request);
    }
}
