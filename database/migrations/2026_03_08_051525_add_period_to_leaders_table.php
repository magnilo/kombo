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
        Schema::table('leaders', function (Blueprint $table) {
            $table->string('period')->nullable()->after('division'); // e.g., 2024-2025
            $table->string('batch')->nullable()->after('period');   // e.g., 2022
            $table->boolean('is_active')->default(true)->after('batch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leaders', function (Blueprint $table) {
            $table->dropColumn(['period', 'batch', 'is_active']);
        });
    }
};
