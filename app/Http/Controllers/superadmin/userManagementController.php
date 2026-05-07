<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class userManagementController extends Controller
{
    public function index()
    {
        // Authenticated admin name
        $adminName = Auth::user()->name;

        return view('superAdminDashboard.usersManagement', compact('adminName'));
    }
}
