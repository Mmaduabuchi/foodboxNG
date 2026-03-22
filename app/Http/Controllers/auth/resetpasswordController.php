<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $credentials['email'])->first();

        if (!$record || !Hash::check($credentials['token'], $record->token)) {
            return back()->withErrors(['token' => 'Invalid or expired token']);
        }

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        //update the user password
        $user->password = Hash::make($credentials['password']);
        $user->save();

        //delete the token
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successful');
    }
}