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
use App\Http\Controllers\auth\forgotpasswordController;
use App\Http\Controllers\auth\resetpasswordController; 
use App\Http\Controllers\dashboard\TwoFactorController;
use App\Http\Controllers\auth\loginOtpController;
use App\Http\Controllers\dashboard\paymenthistoryController;
use App\Http\Controllers\dashboard\managesubscriptionController;
use App\Http\Controllers\secure\loginController as secureloginController;
use App\Http\Controllers\superadmin\adminHomeController;
use App\Http\Controllers\superadmin\adminManagementController;
use App\Http\Controllers\superadmin\deliveryLogisticsController;
use App\Http\Controllers\superadmin\subscriptionManagementController;
use App\Http\Controllers\superadmin\paymentManagementController;
use App\Http\Controllers\superadmin\systemSettingsController;
use App\Http\Controllers\superadmin\userManagementController;
use App\Http\Controllers\superadmin\inventoryManagementController;
use App\Http\Controllers\superadmin\orderManagementController;
use App\Http\Controllers\superadmin\reportsController;
use App\Http\Controllers\superadmin\supportController;
use App\Http\Controllers\superadmin\managePackagesController;
use App\Http\Controllers\superadmin\staffController;
use App\Http\Controllers\superadmin\PackageItemController;
use App\Http\Controllers\superadmin\subpackagesController;
use App\Http\Controllers\home\welcomeController;
use App\Http\Controllers\home\packagesController;
use App\Http\Controllers\home\contactusController;
use App\Http\Controllers\dashboard\usersupportController;
use App\Http\Controllers\dashboard\trackordersController;
use App\Http\Controllers\dashboard\UserNotificationController;


Route::get('/', [welcomeController::class, 'index'])->name('home');

Route::get('/careers', function () {
    return view('careers');
})->name('careers');

Route::get('/contact_us', [contactusController::class, 'index'])->name('contact_us');
Route::post('/contact_us', [contactusController::class, 'store'])->name('contact_us.store');

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

Route::get('/packages', [packagesController::class, 'index'])->name('packages');

Route::get('/coming-soon', function () {
    return view('comingsoon');
})->name('coming_soon');

//home routes
Route::get('/description', [descriptionController::class, 'index'])->name('description');
Route::get('/student_packages', [studentpackagesController::class, 'index'])->name('student_packages');
Route::get('/family_packages', [familypackagesController::class, 'index'])->name('family_packages');
Route::get('/bachelor_packages', [bachelorpackagesController::class, 'index'])->name('bachelor_packages');
Route::get('/carts', [cartsController::class, 'index'])->name('carts');


Route::middleware('guest')->group(function () {
    //login
    Route::get('/login', [loginController::class, 'index'])->name("login");
    Route::post('/login', [loginController::class, 'store'])->name("login.store");
    //register
    Route::get('/register', [registerController::class, 'index'])->name("register.index");
    Route::post('/register', [registerController::class, 'store'])->name("register.store");
    //forgot password
    Route::get('/forgotpassword', [forgotpasswordController::class, 'index'])->name("forgotpassword");
    Route::post('/forgotpassword', [forgotpasswordController::class, 'store'])->name("forgotpassword.store");
    //reset password
    Route::get('/resetpassword', [resetpasswordController::class, 'index'])->name("resetpassword");
    Route::post('/resetpassword', [resetpasswordController::class, 'store'])->name("resetpassword.store");
    //2fa verify
    Route::get('/otp/verify', [loginOtpController::class, 'show'])->name('otp_verify');
    Route::post('/otp/verify', [loginOtpController::class, 'verify'])->name('otp_verify');
    Route::post('/otp/resend', [loginOtpController::class, 'resend'])->name('otp_resend');




    //admin login routes
    Route::get('/secure/login', [secureloginController::class, 'index'])->name('secure');
    Route::post('/secure/login', [secureloginController::class, 'login'])->name('secure.login');
});


// Email verification
Route::get('/verify-email/{token}', [registerController::class, 'verifyEmail'])->name('verify.email');



Route::middleware(['auth', 'user'])->group(function () {
    //logout
    Route::post('/logout', [loginController::class, 'destroy'])->name("logout");
    
    //users dashboard routes
    Route::get('/dashboard', [homeController::class, 'index'])->name('dashboard');
    Route::get('/settings', [settingsController::class, 'index'])->name('settings');

    //user profile
    Route::get('/userprofile', [userprofileController::class, 'index'])->name('userprofile');
    Route::post('/userprofile', [userprofileController::class, 'update'])->name('userprofile.update');
    Route::post('/password/update', [userprofileController::class, 'updatePassword'])->name('password.update');
    Route::post('/userprofile/upload-image', [userprofileController::class, 'uploadProfileImage'])->name('userprofile.upload-image');
    Route::post('/userprofile/notifications', [userprofileController::class, 'updateNotifications'])->name('userprofile.notifications');

    //support
    Route::get('/support', [usersupportController::class, 'index'])->name('support');
    Route::post('/support', [usersupportController::class, 'store'])->name('support.store');

    //track orders
    Route::get('/track_orders', [trackordersController::class, 'index'])->name('track_orders');

    //user notifications
    Route::post('/notifications/mark-all-read', [UserNotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    
    //subscriptions
    Route::get('/subscriptions', [subscriptionController::class, 'index'])->name('subscriptions');

    //delivery address
    Route::get('/delivery_address', [deliveryaddressController::class, 'index'])->name('delivery_address');
    Route::post('/addresses', [deliveryaddressController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/{id}', [deliveryaddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{id}', [deliveryaddressController::class, 'destroy'])->name('addresses.destroy');

    Route::get('/myorders', [myordersController::class, 'index'])->name('myorders');
    Route::get('/mypackages', [mypackagesController::class, 'index'])->name('mypackages');
    Route::get('/report', [reportController::class, 'index'])->name('report');

    //payment history
    Route::get('/payment_history', [paymenthistoryController::class, 'index'])->name('payment_history');

    //manage subscription
    Route::get('/manage_subscription/{code}', [managesubscriptionController::class, 'index'])->name('manage_subscription');
    Route::post('/subscription/preferences/{code}', [managesubscriptionController::class, 'updatePreferences'])->name('subscription.preferences.update');
    Route::post('/subscription/pause/{code}', [managesubscriptionController::class, 'pause'])->name('subscription.pause');
    Route::post('/subscription/cancel/{code}', [managesubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::post('/subscription/frequency/{code}', [managesubscriptionController::class, 'updateFrequency'])->name('subscription.frequency.update');
    Route::post('/subscription/resume/{code}', [managesubscriptionController::class, 'resume'])->name('subscription.resume');

    // 2FA routes
    Route::post('/2fa/toggle', [TwoFactorController::class, 'toggle'])->name('2fa.toggle');

    // Account deactivation
    Route::post('/account/deactivate', [userprofileController::class, 'deactivate'])->name('account.deactivate');


    // cart delivery
    Route::get('/delivery_cart', [cartsController::class, 'delivery_cart'])->name('delivery_cart');

});







Route::middleware(['auth', 'admin'])->group(function () {
    
    //admin logout
    Route::post('/secure/logout', [adminHomeController::class, 'logout'])->name('secure.logout');

    //admin dashboard
    Route::get('/admin/dashboard', [adminHomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/adminManagement', [adminManagementController::class, 'index'])->name('admin.adminManagement');
    Route::get('/admin/deliveryLogistics', [deliveryLogisticsController::class, 'index'])->name('admin.deliveryLogistics');
    Route::get('/admin/subscriptionManagement', [subscriptionManagementController::class, 'index'])->name('admin.subscriptionManagement');
    Route::get('/admin/paymentManagement', [paymentManagementController::class, 'index'])->name('admin.paymentManagement');
    Route::get('/admin/systemSettings', [systemSettingsController::class, 'index'])->name('admin.systemSettings');
    
    //users management
    Route::get('/admin/userManagement', [userManagementController::class, 'index'])->name('admin.userManagement');
    Route::patch('/admin/userManagement/toggle-suspend/{id}', [userManagementController::class, 'toggleSuspend'])->name('admin.userManagement.toggle-suspend');
    Route::get('/admin/userManagement/export', [userManagementController::class, 'export'])->name('admin.userManagement.export');
    
    
    //inventory management
    Route::get('/admin/inventoryManagement', [inventoryManagementController::class, 'index'])->name('admin.inventoryManagement');
    
    //orders management
    Route::get('/admin/orderManagement', [orderManagementController::class, 'index'])->name('admin.orderManagement');
    
    //reports
    Route::get('/admin/reports', [reportsController::class, 'index'])->name('admin.reports');
    
    //support
    Route::get('/admin/support', [supportController::class, 'index'])->name('admin.support');

    //manage packages
    Route::get('/admin/managePackages', [managePackagesController::class, 'index'])->name('admin.managePackages');
    Route::delete('/admin/managePackages/{id}', [managePackagesController::class, 'destroy'])->name('admin.managePackages.delete');
    Route::patch('/admin/managePackages/{package}/activate', [managePackagesController::class, 'activate'])->name('admin.managePackages.activate');
    Route::patch('/admin/managePackages/{package}/deactivate', [managePackagesController::class, 'deactivate'])->name('admin.managePackages.deactivate');
    
    //update password
    Route::post('/admin/password/update', [systemSettingsController::class, 'updatePassword'])->name('admin.password.update');

    //staff management
    Route::post('/admin/staffManagement', [staffController::class, 'store'])->name('admin.staffManagement');
    Route::get('/admin/staff/{id}/edit', [staffController::class, 'edit'])->name('admin.staff.edit');
    Route::put('/admin/staff/{id}', [staffController::class, 'update'])->name('admin.staff.update');
    Route::post('/admin/staff/{id}/suspend', [staffController::class, 'suspend'])->name('admin.staff.suspend');
    Route::post('/admin/staff/{id}/activate', [staffController::class, 'activate'])->name('admin.staff.activate');

    //system settings
    Route::post('/admin/updateCustomerSupport', [systemSettingsController::class, 'updateCustomerSupport'])->name('admin.updateCustomerSupport');



    // Inventory AJAX routes
    Route::get('/admin/packages/{id}/subpackages', function ($id) {
        $subPackages = \App\Models\SubPackages::where('package_id', $id)
            ->withCount('items')
            ->get();
        return response()->json(['subPackages' => $subPackages]);
    })->name('admin.packages.subpackages');

    Route::get('/admin/subpackages/{id}/items', function ($id) {
        $items = \App\Models\PackageItem::where('sub_package_id', $id)->get();
        return response()->json(['items' => $items]);
    })->name('admin.subpackages.items');

    //add and delete sub package items
    Route::post('/admin/subpackages/items/store', [PackageItemController::class, 'store'])->name('admin.subpackages.items.store');
    Route::delete('/admin/subpackages/items/{id}/delete', [PackageItemController::class, 'destroy'])->name('admin.subpackages.items.destroy');

    //add and delete sub packages
    Route::post('/admin/subpackages/store', [subpackagesController::class, 'store'])->name('admin.subpackages.store');
    Route::delete('/admin/subpackages/{id}/delete', [subpackagesController::class, 'destroy'])->name('admin.subpackages.delete');
});