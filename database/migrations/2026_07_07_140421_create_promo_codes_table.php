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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique();
            $table->string('title', 100);
            $table->text('description')->nullable();

            $table->enum('discount_type', [
                'percentage',
                'fixed',
                'free_shipping'
            ]);

            $table->decimal('discount_value', 10, 2)->default(0);
            $table->decimal('minimum_order_amount', 10, 2)->default(0);
            $table->decimal('maximum_discount', 10, 2)->nullable();

            $table->unsignedInteger('usage_limit')->nullable();
            $table->unsignedInteger('used_count')->default(0);
            $table->unsignedInteger('per_customer_limit')->default(1);

            $table->dateTime('starts_at');
            $table->dateTime('expires_at');

            $table->enum('status', [
                'active',
                'inactive',
                'expired'
            ])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
