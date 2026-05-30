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
        Schema::create('sub_packages', function (Blueprint $table) {
            $table->id();

            // Foreign key
            $table->foreignId('package_id')
                ->constrained('packages')
                ->onDelete('cascade');

            // Basic details
            $table->string('name');
            $table->decimal('price', 15, 2);

            // Media
            $table->string('image')->nullable();

            // Descriptions
            $table->string('short_description');
            $table->text('description');

            // Billing
            $table->string('billing_cycle');

            // Status
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->boolean('is_available')->default(true);

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_packages');
    }
};
