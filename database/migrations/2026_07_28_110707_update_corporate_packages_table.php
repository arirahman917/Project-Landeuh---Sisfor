<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('corporate_packages', function (Blueprint $table) {
            $table->dropColumn(['kasur', 'merokok']);
            $table->string('jenis_akomodasi', 100)->nullable()->after('jenis');
            $table->json('accommodation_ids')->nullable()->after('jenis_akomodasi');
        });

        // Update existing data with relational IDs
        DB::table('corporate_packages')->where('jenis', 'Corporate Glamping')->update([
            'jenis_akomodasi' => 'Glamping',
            'accommodation_ids' => json_encode([3, 12]),
            'slot' => 2,
        ]);

        DB::table('corporate_packages')->where('jenis', 'Corporate Cabin')->update([
            'jenis_akomodasi' => 'Cabin',
            'accommodation_ids' => json_encode([1, 4, 5, 6, 7, 8, 9, 10]),
            'slot' => 8,
        ]);

        // Clean up old corporate entries from accommodations table
        DB::table('accommodations')->whereIn('jenis', ['Corporate Glamping', 'Corporate Cabin'])->delete();
    }

    public function down(): void
    {
        Schema::table('corporate_packages', function (Blueprint $table) {
            $table->dropColumn(['jenis_akomodasi', 'accommodation_ids']);
            $table->string('kasur')->nullable()->after('jenis');
            $table->boolean('merokok')->default(false)->after('kasur');
        });
    }
};

