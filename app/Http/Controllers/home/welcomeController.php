<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Package;
use App\Models\SubPackages;

class welcomeController extends Controller
{
    public function index()
    {
        $packages = Package::active()
            ->with(['subPackages' => function($query){
                $query->active();
            }])
            ->get();

        return view('welcome', compact('packages'));
    }
}
