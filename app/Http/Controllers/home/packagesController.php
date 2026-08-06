<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class packagesController extends Controller
{
    //
    public function index(){
        $packages = Package::active()
            ->with(['subPackages' => function($query){
                $query->active();
            }])
            ->get();

        // dd($packages);

        return view('packages', compact('packages'));
    }
}