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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('jenis', 100);
            $table->string('kasur');
            $table->boolean('merokok')->default(false);
            $table->json('fasilitas');
            $table->json('makanan');
            $table->integer('max_orang');
            $table->json('catatan');
            $table->integer('slot');
            $table->decimal('harga_weekday', 12, 2);
            $table->decimal('harga_weekend', 12, 2);
            $table->decimal('harga_highseason', 12, 2);
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
