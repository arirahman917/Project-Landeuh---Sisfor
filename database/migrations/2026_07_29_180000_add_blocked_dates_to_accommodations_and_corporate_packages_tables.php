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
        Schema::table('accommodations', function (Blueprint $table) {
            $table->text('blocked_dates')->nullable()->after('gambar');
        });

        Schema::table('corporate_packages', function (Blueprint $table) {
            $table->text('blocked_dates')->nullable()->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn('blocked_dates');
        });

        Schema::table('corporate_packages', function (Blueprint $table) {
            $table->dropColumn('blocked_dates');
        });
    }
};
