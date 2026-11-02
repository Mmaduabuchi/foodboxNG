<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UserNotification;
use App\Models\AdminNotification;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (Auth::check()) {

                $notifications = UserNotification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->latest()
                    ->take(10)
                    ->get();

                $unreadCount = UserNotification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();

                $view->with([
                    'notifications' => $notifications,
                    'unreadCount' => $unreadCount,
                ]);
            }

        });


        // Admin notifications
        View::composer('superAdminDashboard.header', function ($view) {

            $adminNotifications = AdminNotification::where('is_read', false)->latest()
                ->take(10)
                ->get();

            $adminUnreadCount = AdminNotification::where('is_read', false)
                ->count();

            $view->with(compact(
                'adminNotifications',
                'adminUnreadCount'
            ));

        });


        RateLimiter::for('checkout', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->user()?->id ?: $request->ip())
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Too many checkout attempts. Please wait a minute and try again.',
                    ], 429, $headers);
                });
        });

        
    }
}
