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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan')->unique();
            $table->foreignId('accommodation_id')->constrained('accommodations')->onDelete('cascade');
            $table->string('pemesan_nama');
            $table->string('pemesan_telp');
            $table->string('pemesan_email');
            $table->string('nama_tamu');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('malam');
            $table->integer('tambahan_anak')->default(0);
            $table->integer('tambahan_dewasa')->default(0);
            $table->decimal('total', 12, 2);
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
