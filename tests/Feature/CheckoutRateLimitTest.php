<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Route;

class CheckoutRateLimitTest extends TestCase
{
    public function test_checkout_is_limited_to_five_requests_per_minute(): void
    {
        Route::post('/testing/checkout-throttle', function () {
            return response()->json(['success' => true]);
        })->middleware('throttle:checkout');

        for ($i = 1; $i <= 5; $i++) {
            $this->postJson('/testing/checkout-throttle')
                ->assertOk();
        }

        $this->postJson('/testing/checkout-throttle')
            ->assertStatus(429)
            ->assertJson([
                'success' => false,
                'message' => 'Too many checkout attempts. Please wait a minute and try again.',
            ]);
    }
}

