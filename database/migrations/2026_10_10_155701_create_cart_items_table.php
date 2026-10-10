<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_id')
                ->constrained('carts')
                ->cascadeOnDelete();

            // Assumes your package table is named "packages".
            $table->foreignId('sub_package_id')
                ->constrained('sub_packages')
                ->cascadeOnDelete();

            // one_time or monthly
            $table->string('purchase_type', 20)
                ->default('one_time');

            $table->unsignedSmallInteger('quantity')
                ->default(1);

            // Price per package when it was added.
            $table->decimal('unit_price', 12, 2);

            $table->timestamps();

            // Prevent duplicate rows for the same package
            // and purchase type within one cart.
            $table->unique(
                ['cart_id', 'sub_package_id', 'purchase_type'],
                'cart_items_unique_subpackage_type'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};