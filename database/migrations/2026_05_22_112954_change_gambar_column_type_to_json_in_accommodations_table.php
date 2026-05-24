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
        // Convert existing string data to JSON array
        $accommodations = \Illuminate\Support\Facades\DB::table('accommodations')->get();
        foreach ($accommodations as $accommodation) {
            $decoded = json_decode($accommodation->gambar, true);
            if (!is_array($decoded)) {
                \Illuminate\Support\Facades\DB::table('accommodations')
                    ->where('id', $accommodation->id)
                    ->update(['gambar' => json_encode([$accommodation->gambar])]);
            }
        }

        Schema::table('accommodations', function (Blueprint $table) {
            $table->json('gambar')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->string('gambar')->change();
        });
        
        // Convert JSON array back to string (taking the first element)
        $accommodations = \Illuminate\Support\Facades\DB::table('accommodations')->get();
        foreach ($accommodations as $accommodation) {
            $decoded = json_decode($accommodation->gambar, true);
            if (is_array($decoded) && count($decoded) > 0) {
                \Illuminate\Support\Facades\DB::table('accommodations')
                    ->where('id', $accommodation->id)
                    ->update(['gambar' => $decoded[0]]);
            }
        }
    }
};
