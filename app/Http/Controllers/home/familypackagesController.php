<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Package;

class familypackagesController extends Controller
{
    public function index(){
        $familyPackages = Package::where('category', 'family')
            ->with([
                'subPackages' => function($query){
                    $query->where('status', 'active')
                    ->where('is_available', 1)
                    ->with('items');
                }
            ])
            ->get();

        return view('family', compact('familyPackages'));
    }
}