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
        Schema::table('orders', function (Blueprint $table) {
            $table->date('scheduled_date')->nullable()->after('delivery_zone');
            $table->time('delivery_start_time')->nullable()->after('scheduled_date');
            $table->time('delivery_end_time')->nullable()->after('delivery_start_time');
            $table->string('delivery_status')->nullable()->after('delivery_end_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['scheduled_date', 'delivery_start_time', 'delivery_end_time', 'delivery_status']);
        });
    }
};
