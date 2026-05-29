<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::where('email', 'admin1@gmail.com')->delete();
        User::factory()->create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'phone' => '081234567890',
            'password' => bcrypt('admin1'),
            'role' => 'admin',
        ]);

        User::where('email', 'admin2@gmail.com')->delete();
        User::factory()->create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'phone' => '081234567890',
            'password' => bcrypt('admin2'),
            'role' => 'admin',
        ]);

        $this->call([
            DateSettingSeeder::class,
            AccommodationSeeder::class,
            // BookingSeeder::class,
        ]);
    }
}
