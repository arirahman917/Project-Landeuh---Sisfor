<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Accommodation;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $accommodations = Accommodation::all();
        $tamNames = ['M. Akbar R.','Budi S.','Citra D.','Dian P.','Eka W.'];
        $payMethods = ['Virtual Account BCA','Virtual Account Mandiri','QRIS','Minimarket','ATM Transfer'];

        if ($accommodations->count() == 0) return;

        for ($i = 0; $i < 20; $i++) {
            $checkin = Carbon::now()->addDays($i % 5);
            $nights = 1 + ($i % 3);
            $checkout = $checkin->copy()->addDays($nights);
            
            $akom = $accommodations->random();

            Booking::create([
                'no_pesanan' => 'ORD-' . strtoupper(substr(uniqid(), -8)),
                'accommodation_id' => $akom->id,
                'pemesan_nama' => 'Ari Rahman',
                'pemesan_telp' => '081234567890',
                'pemesan_email' => 'arirahman@gmail.com',
                'nama_tamu' => $tamNames[$i % count($tamNames)],
                'check_in_date' => $checkin,
                'check_out_date' => $checkout,
                'malam' => $nights,
                'tambahan_anak' => rand(0, 2),
                'tambahan_dewasa' => rand(0, 1),
                'total' => $akom->harga_weekday * $nights,
                'metode_pembayaran' => $payMethods[$i % count($payMethods)],
            ]);
        }
    }
}
