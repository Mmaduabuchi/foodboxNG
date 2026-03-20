<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class deliveryaddressController extends Controller
{
    //
    public function index(){
        return view('dashboard.delivery_address');
    }
}
