<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class reportController extends Controller
{
    //
    public function index(){
        return view('dashboard.report_missing_item');
    }
}
