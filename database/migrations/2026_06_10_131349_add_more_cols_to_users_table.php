<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('delivery_notifications')
              ->default(true)
              ->after('referred_by');

            $table->boolean('billing_notifications')
                ->default(true)
                ->after('delivery_notifications');

            $table->boolean('marketing_notifications')
                ->default(false)
                ->after('billing_notifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'delivery_notifications',
                'billing_notifications',
                'marketing_notifications'
            ]);
        });
    }
};
