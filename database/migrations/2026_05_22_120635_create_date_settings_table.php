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
        Schema::create('date_settings', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'weekday', 'weekend', 'highseason'
            $table->string('name')->nullable(); // Optional name, mainly for highseason
            $table->text('dates'); // Comma-separated dates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('date_settings');
    }
};
