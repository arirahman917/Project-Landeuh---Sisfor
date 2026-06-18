<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        // Fetch successful, refunded, refund_pending, and refund_rejected bookings
        $bookings = Booking::with('accommodation')
            ->whereIn('status', ['success', 'refund_rejected', 'refunded', 'refund_pending'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Format for the frontend JS
        $formattedBookings = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'noPesanan' => $booking->no_pesanan,
                'pemesanNama' => $booking->pemesan_nama,
                'pemesanTelp' => $booking->pemesan_telp,
                'pemesanEmail' => $booking->pemesan_email,
                'namaTamu' => $booking->nama_tamu,
                'akomodasi' => $booking->accommodation->judul,
                'akomodasiCap' => '(' . $booking->accommodation->max_orang . ' pax)',
                'malam' => $booking->malam,
                'tanggalDipesan' => $booking->created_at->locale('id')->isoFormat('D MMM YYYY'),
                'checkin' => $booking->check_in_date->locale('id')->isoFormat('ddd, D MMM YYYY'),
                'checkout' => $booking->check_out_date->locale('id')->isoFormat('ddd, D MMM YYYY'),
                'tambahanAnak' => $booking->tambahan_anak,
                'tambahanDewasa' => $booking->tambahan_dewasa,
                'total' => $booking->total,
                'metode' => $booking->metode_pembayaran,
                'status' => $booking->status,
            ];
        });

        return view('admin.pesanan.index', compact('formattedBookings'));
    }
}
