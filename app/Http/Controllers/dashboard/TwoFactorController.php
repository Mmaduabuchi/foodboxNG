<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorEnabled;

class TwoFactorController extends Controller
{
    public function toggle(Request $request) {
        $user = $request->user();

        $enabled = $request->boolean('two_factor_enabled');

        $user->two_factor_enabled = $enabled;
        $user->save();

        //send email notification
        Mail::to($user->email)->send(new TwoFactorEnabled($user, $enabled ? 'enabled' : 'disabled'));

        if ($enabled) {
            return back()->with('success', 'Two-factor authentication enabled successfully!');
        }

        return back()->with('success', 'Two-factor authentication disabled successfully!');
    }
}
