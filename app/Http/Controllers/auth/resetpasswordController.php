<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;


class resetpasswordController extends Controller
{
    //
    public function index(Request $request){

        $token = $request->query('token');
        $email = $request->query('email');

        return view("resetpassword", compact('token', 'email'));
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        $email = strtolower(trim($credentials['email']));

        //Rate Limiting
        // Limit attempts for this email + IP
        $emailRateLimitKey = 'password-reset|' . $request->ip() . '|' . $email;

        if (RateLimiter::tooManyAttempts($emailRateLimitKey, 5)) {

            $seconds = RateLimiter::availableIn($emailRateLimitKey);

            Log::warning('Password reset rate limit exceeded', [
                'email' => $email,
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many password reset attempts. Please try again in {$seconds} seconds.",
                ]);
        }

        // Limit attempts from the same IP
        $ipRateLimitKey = 'password-reset-ip|' . $request->ip();

        if (RateLimiter::tooManyAttempts($ipRateLimitKey, 20)) {

            $seconds = RateLimiter::availableIn($ipRateLimitKey);

            Log::warning('Password reset IP rate limit exceeded', [
                'ip' => $request->ip(),
                'retry_after' => $seconds,
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many password reset attempts from this network. Please try again in {$seconds} seconds.",
                ]);
        }


        RateLimiter::hit($emailRateLimitKey, 600);
        RateLimiter::hit($ipRateLimitKey, 600);


        //Find Password Reset Token
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        //Check Token
        if (!$record) {

            Log::warning('Password reset token not found', [
                'email' => $email,
                'ip' => $request->ip(),
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'token' => 'Invalid or expired token.',
                ]);
        }

        //Check Token Expiration
        $tokenCreatedAt = Carbon::parse($record->created_at);

        $expireMinutes = config('auth.passwords.users.expire', 60);

        if ($tokenCreatedAt->addMinutes($expireMinutes)->isPast()) {

            Log::warning('Expired password reset token submitted', [
                'email' => $email,
                'ip' => $request->ip(),
            ]);

            // Delete expired token
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'token' => 'This password reset link has expired. Please request a new one.',
                ]);
        }


        //Verify Token
        if (!Hash::check($credentials['token'], $record->token)) {
            Log::warning('Invalid password reset token submitted', [
                'email' => $email,
                'ip' => $request->ip(),
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['token' => 'Invalid or expired token']);
        }

        //Find User
        $user = User::where('email', $email)->first();

        if (!$user) {

            Log::warning('Password reset attempted for nonexistent user', [
                'email' => $email,
                'ip' => $request->ip(),
            ]);

            return back()->withErrors(['email' => 'Email not found']);
        }

        //update the user password
        $user->password = Hash::make($credentials['password']);

        // Invalidate all existing authenticated sessions
        $user->active_session_id = null;

        $user->save();

        //Delete Password Reset Token
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        //Clear Rate Limits
        RateLimiter::clear($emailRateLimitKey);

        //Log Successful Password Reset
        Log::info('User password reset successfully', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('login')->with('success', 'Password reset successful');
    }
}