<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DateSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\DateSetting::truncate();

        \App\Models\DateSetting::create([
            'type' => 'weekday',
            'name' => 'Weekday',
            'dates' => 'Minggu, Senin, Selasa, Rabu, Kamis',
        ]);

        \App\Models\DateSetting::create([
            'type' => 'weekend',
            'name' => 'Weekend',
            'dates' => "Jum'at, Sabtu, 2026-01-01, 2026-01-16, 2026-02-16, 2026-02-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-04-03, 2026-04-05, 2026-05-01, 2026-05-12, 2026-05-14, 2026-05-15, 2026-05-27, 2026-06-01, 2026-06-16, 2026-08-17, 2026-08-25, 2026-12-25",
        ]);

        \App\Models\DateSetting::create([
            'type' => 'highseason',
            'name' => 'Tahun Baru & Semester Ganjil',
            'dates' => '2026-01-01, 2026-01-02, 2026-01-03, 2026-01-04',
        ]);

        \App\Models\DateSetting::create([
            'type' => 'highseason',
            'name' => 'Lebaran Idul Fitri',
            'dates' => '2026-03-16, 2026-03-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-03-25, 2026-03-26, 2026-03-27, 2026-03-28, 2026-03-29',
        ]);

        \App\Models\DateSetting::create([
            'type' => 'highseason',
            'name' => 'Lebaran Idul Adha',
            'dates' => '2026-05-27, 2026-05-28, 2026-05-29, 2026-05-30, 2026-05-31',
        ]);

        \App\Models\DateSetting::create([
            'type' => 'highseason',
            'name' => 'Kenaikan Kelas (Semester Genap)',
            'dates' => '2026-06-22, 2026-06-23, 2026-06-24, 2026-06-25, 2026-06-26, 2026-06-27, 2026-06-28, 2026-06-29, 2026-06-30, 2026-07-01, 2026-07-02, 2026-07-03, 2026-07-04, 2026-07-05, 2026-07-06, 2026-07-07, 2026-07-08, 2026-07-09, 2026-07-10, 2026-07-11',
        ]);

        \App\Models\DateSetting::create([
            'type' => 'highseason',
            'name' => 'Natal & Semester Ganjil',
            'dates' => '2026-12-21, 2026-12-22, 2026-12-23, 2026-12-24, 2026-12-25, 2026-12-26, 2026-12-27, 2026-12-28, 2026-12-29, 2026-12-30, 2026-12-31',
        ]);
    }
}
