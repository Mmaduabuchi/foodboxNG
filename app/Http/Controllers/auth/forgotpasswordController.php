<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class forgotpasswordController extends Controller
{
    //
    public function index(){
        return view("forgotpassword");
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->with('status', 'If the email exists, a reset link has been sent');
        }

        try {
            //delete old tokens
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            
            $plainToken = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => Hash::make($plainToken),
                'created_at' => now(),
            ]);

            Mail::to($user->email)->send(new ResetPasswordMail($plainToken, $user->email));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Failed to send email. Try again later.');
        }

        return back()->with('status', 'If your email exists, a reset link has been sent.');
    }
}
