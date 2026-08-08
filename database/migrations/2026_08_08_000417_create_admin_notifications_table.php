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
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);

            $table->text('message');

            $table->enum('type', [
                'support',
                'order',
                'payment',
                'delivery',
                'user',
                'promotion',
                'system',
            ]);

            $table->string('icon', 100)->nullable();

            $table->string('url')->nullable();

            $table->unsignedBigInteger('reference_id')->nullable();

            $table->boolean('is_read')->default(false)->index();

            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};
