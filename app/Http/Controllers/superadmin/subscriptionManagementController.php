<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class subscriptionManagementController extends Controller
{
    public function index()
    {
        return view('superAdminDashboard.subscriptionsManagement');
    }
}
