<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class trackordersController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.trackorders', compact('user'));
    }
}
