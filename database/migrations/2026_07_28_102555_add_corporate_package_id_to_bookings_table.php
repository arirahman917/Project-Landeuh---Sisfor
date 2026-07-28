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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('accommodation_id')->nullable()->change();
            $table->foreignId('corporate_package_id')->nullable()->after('accommodation_id')->constrained('corporate_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['corporate_package_id']);
            $table->dropColumn('corporate_package_id');
            $table->foreignId('accommodation_id')->nullable(false)->change();
        });
    }
};
