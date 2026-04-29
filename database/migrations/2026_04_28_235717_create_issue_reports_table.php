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
        Schema::create('issue_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete(); 
            $table->foreignId('package_id')->nullable()->constrained()->nullOnDelete();

            $table->string('issue_type'); 
            $table->text('description');

            $table->json('affected_items')->nullable(); 

            $table->string('status')->default('pending'); 
            // pending | investigating | resolved | rejected

            $table->string('reference')->unique(); 

            $table->text('admin_notes')->nullable();
            $table->text('resolution')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_reports');
    }
};
