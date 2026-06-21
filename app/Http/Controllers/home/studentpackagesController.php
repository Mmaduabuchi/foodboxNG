<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Package;

class studentpackagesController extends Controller
{
    public function index(){
        
        $studentPackages = Package::where('category', 'student')
            ->with([
                'subPackages' => function($query){
                    $query->where('status', 'active')
                    ->where('is_available', 1)
                    ->with('items');
                }
            ])
            ->get();

        return view('students', compact('studentPackages'));
    }
}