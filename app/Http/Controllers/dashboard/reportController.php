<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reportController extends Controller
{
    //
    public function index(){
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }
        
        return view('dashboard.report_missing_item', compact('user'));
    }
}
