<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminHomeController extends Controller
{
    //
    public function index(){
        return view("superAdminDashboard.home");
    }

    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('secure.login')->with('success', 'Logged out successfully');
    }
}
