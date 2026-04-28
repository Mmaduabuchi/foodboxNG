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
            $table->foreignId('package_id')->after('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('subscription_id')
                ->nullable()
                ->after('package_id')
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropForeign(['subscription_id']);

            $table->dropColumn(['package_id', 'subscription_id']);
        });
    }
};
