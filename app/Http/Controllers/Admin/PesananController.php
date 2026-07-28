<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['accommodation', 'corporatePackage'])
            ->whereIn('status', ['success', 'reschedule_rejected', 'rescheduled', 'reschedule_pending', 'pending'])
            ->orderBy('created_at', 'desc')
            ->get();

        $formattedBookings = $bookings->map(function ($booking) {
            $isCorporate = !is_null($booking->corporate_package_id);

            if ($isCorporate && $booking->corporatePackage) {
                $paxVal = !empty($booking->jumlah_pax) ? $booking->jumlah_pax : $booking->corporatePackage->max_orang;
                $akomodasiLabel = $booking->corporatePackage->judul;
                $akomodasiCap   = '(' . $paxVal . ' pax)';
            } elseif (!$isCorporate && $booking->accommodation) {
                $akomodasiLabel = $booking->accommodation->judul;
                $akomodasiCap   = '(' . $booking->accommodation->max_orang . ' pax)';
            } else {
                $akomodasiLabel = '—';
                $akomodasiCap   = '';
            }

            return [
                'id'              => $booking->id,
                'noPesanan'       => $booking->no_pesanan,
                'pemesanNama'     => $booking->pemesan_nama,
                'pemesanTelp'     => $booking->pemesan_telp,
                'pemesanEmail'    => $booking->pemesan_email,
                'namaTamu'        => $booking->nama_tamu,
                'akomodasi'       => $akomodasiLabel,
                'akomodasiCap'    => $akomodasiCap,
                'malam'           => $booking->malam,
                'tanggalDipesan'  => $booking->created_at->locale('id')->isoFormat('D MMM YYYY'),
                'raw_date'        => $booking->created_at->format('Y-m-d'),
                'checkin'         => $booking->check_in_date->locale('id')->isoFormat('ddd, D MMM YYYY'),
                'checkout'        => $booking->check_out_date->locale('id')->isoFormat('ddd, D MMM YYYY'),
                'tambahanAnak'    => $booking->tambahan_anak,
                'tambahanDewasa'  => $booking->tambahan_dewasa,
                'total'           => $booking->total,
                'metode'          => $booking->metode_pembayaran,
                'status'          => $booking->status,
                'isCorporate'     => $isCorporate,
            ];
        });

        return view('admin.pesanan.index', compact('formattedBookings'));
    }
}
