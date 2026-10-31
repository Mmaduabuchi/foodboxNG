<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Order identification
            $table->string('order_reference')->nullable()->unique();

            // Order pricing
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);

            // Delivery information
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('delivery_method')->nullable();
            $table->text('delivery_instructions')->nullable();

            // Delivery scheduling
            $table->date('scheduled_date')->nullable();
            $table->time('delivery_start_time')->nullable();
            $table->time('delivery_end_time')->nullable();

            // Delivery tracking
            $table->string('delivery_status')->default('pending');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique(['order_reference']);

            $table->dropColumn([
                'order_reference',
                'subtotal',
                'shipping_fee',
                'discount',
                'address_id',
                'delivery_method',
                'delivery_instructions',
                'scheduled_date',
                'delivery_start_time',
                'delivery_end_time',
                'delivery_status',
            ]);
        });
    }
};