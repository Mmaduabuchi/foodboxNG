<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\auth\registerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [loginController::class, 'index'])->name("login.index");
Route::get('/register', [registerController::class, 'index'])->name("register.index");

Route::get('/careers', function () {
    return view('careers');
})->name('careers');

Route::get('/contact_us', function () {
    return view('contact_us');
})->name('contact_us');

Route::get('/about_us', function () {
    return view('about_us');
})->name('about_us');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/faqs', function () {
    return view('faq');
})->name('faqs');

Route::get('/shipping_policy', function () {
    return view('policy');
})->name('shipping_policy');

Route::get('/returns', function () {
    return view('returns');
})->name('returns');

Route::get('/terms_of_service', function () {
    return view('terms_of_service');
})->name('terms_of_service');

Route::get('/packages', function () {
    return view('packages');
})->name('packages');