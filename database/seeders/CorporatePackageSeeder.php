<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorporatePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Accommodation::create([
            'judul' => 'Paket Corporate Glamping',
            'jenis' => 'Corporate Glamping',
            'kasur' => 'Sesuai kapasitas seluruh unit Glamping VIP & Reguler',
            'merokok' => false,
            'fasilitas' => ['Menginap di area Glamping', 'Penggunaan seluruh Glamping VIP & Reguler'],
            'makanan' => ['Makan 3 kali per malam'],
            'max_orang' => 150,
            'catatan' => ['Minimal pemesanan 25 pax.', 'Harga dihitung per peserta (per pax).', 'Check-in 14.00–21.00.', 'Check-out 12.00.'],
            'slot' => 1,
            'harga_weekday' => 400000,
            'harga_weekend' => 400000,
            'harga_highseason' => 400000,
            'gambar' => [
                'https://res.cloudinary.com/dj6ckubpl/image/upload/v1785141479/landeuh-akomodasi/jllq7pstakxi8vedperl.webp',
                'https://res.cloudinary.com/dj6ckubpl/image/upload/v1785141344/landeuh-akomodasi/wi608adozqxrysxrut35.webp'
            ],
        ]);

        \App\Models\Accommodation::create([
            'judul' => 'Paket Corporate Cabin',
            'jenis' => 'Corporate Cabin',
            'kasur' => 'Sesuai kapasitas seluruh unit Cabin',
            'merokok' => false,
            'fasilitas' => ['Menginap di area Cabin', 'Penggunaan seluruh unit Cabin (1 - 8)'],
            'makanan' => ['Makan 3 kali per malam'],
            'max_orang' => 150,
            'catatan' => ['Minimal pemesanan 25 pax.', 'Harga dihitung per peserta (per pax).', 'Check-in 14.00–21.00.', 'Check-out 12.00.'],
            'slot' => 1,
            'harga_weekday' => 500000,
            'harga_weekend' => 500000,
            'harga_highseason' => 500000,
            'gambar' => [
                'https://res.cloudinary.com/dj6ckubpl/image/upload/v1785071160/landeuh-akomodasi/w1ubhod0gl1mnuenp4h1.jpg',
                'https://res.cloudinary.com/dj6ckubpl/image/upload/v1785139260/landeuh-akomodasi/rdstvqdcbd6qfyml5kdr.webp'
            ],
        ]);
    }
}
