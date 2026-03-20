<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\auth\registerController;
use App\Http\Controllers\home\descriptionController;
use App\Http\Controllers\home\familypackagesController;
use App\Http\Controllers\home\studentpackagesController;
use App\Http\Controllers\home\bachelorpackagesController;
use App\Http\Controllers\home\cartsController;
use App\Http\Controllers\dashboard\homeController;
use App\Http\Controllers\dashboard\settingsController;
use App\Http\Controllers\dashboard\userprofileController;
use App\Http\Controllers\dashboard\subscriptionController;
use App\Http\Controllers\dashboard\deliveryaddressController;
use App\Http\Controllers\dashboard\editaddressController;
use App\Http\Controllers\dashboard\myordersController;
use App\Http\Controllers\dashboard\mypackagesController;
use App\Http\Controllers\dashboard\reportController;

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

//home routes
Route::get('/description', [descriptionController::class, 'index'])->name('description');
Route::get('/student_packages', [studentpackagesController::class, 'index'])->name('student_packages');
Route::get('/family_packages', [familypackagesController::class, 'index'])->name('family_packages');
Route::get('/bachelor_packages', [bachelorpackagesController::class, 'index'])->name('bachelor_packages');
Route::get('/carts', [cartsController::class, 'index'])->name('carts');

//users dashboard routes
Route::get('/dashboard', [homeController::class, 'index'])->name('dashboard');
Route::get('/settings', [settingsController::class, 'index'])->name('settings');
Route::get('/userprofile', [userprofileController::class, 'index'])->name('userprofile');
Route::get('/subscriptions', [subscriptionController::class, 'index'])->name('subscriptions');
Route::get('/delivery_address', [deliveryaddressController::class, 'index'])->name('delivery_address');
Route::get('/edit_address', [editaddressController::class, 'index'])->name('edit_address');
Route::get('/myorders', [myordersController::class, 'index'])->name('myorders');
Route::get('/mypackages', [mypackagesController::class, 'index'])->name('mypackages');
Route::get('/report', [reportController::class, 'index'])->name('report');