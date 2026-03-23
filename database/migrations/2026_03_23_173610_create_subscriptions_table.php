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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            //Relationships
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();

            // Subscription Details
            $table->enum('status', ['active', 'paused', 'cancelled'])->default('active');

            $table->enum('delivery_frequency', ['weekly', 'bi-weekly', 'monthly']);
            $table->string('delivery_zone');

            $table->date('next_renewal_date')->nullable();
            $table->date('last_renewal_date')->nullable();

            // Lifecycle Tracking
            $table->timestamp('paused_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
