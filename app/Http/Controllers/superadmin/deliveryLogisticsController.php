<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class deliveryLogisticsController extends Controller
{
    public function index()
    {
        return view('superAdminDashboard.deliveryLogistics');
    }
}
