<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class editaddressController extends Controller
{
    //
    public function index(){
        return view('dashboard.edit_delivery_address');
    }
}
