<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class settingsController extends Controller
{
    //
    public function index() {
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        return view('dashboard.settings', compact('user'));
    }
}
