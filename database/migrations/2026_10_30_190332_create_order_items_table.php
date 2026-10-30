<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('sub_package_id')
                ->nullable()
                ->constrained('sub_packages')
                ->nullOnDelete();

            // Preserve product information at purchase time
            $table->string('package_name');
            $table->string('subpackage_name');

            $table->enum('purchase_type', ['one_time', 'monthly'])
                ->default('one_time');

            $table->unsignedInteger('quantity')->default(1);

            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};