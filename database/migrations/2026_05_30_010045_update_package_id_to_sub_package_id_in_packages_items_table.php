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
        Schema::table('package_items', function (Blueprint $table) {
            // Drop old foreign key
            $table->dropForeign(['package_id']);

            // Remove old column
            $table->dropColumn('package_id');

            // Add new foreign key
            $table->foreignId('sub_package_id')
                ->constrained('sub_packages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_items', function (Blueprint $table) {
            // Drop new foreign key
            $table->dropForeign(['sub_package_id']);

            // Remove new column
            $table->dropColumn('sub_package_id');

            // Restore old column
            $table->foreignId('package_id')
                ->constrained('packages')
                ->onDelete('cascade');
        });
    }
};
