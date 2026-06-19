<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use App\Mail\BookingSuccessMail;
use Illuminate\Support\Facades\Mail;

class ReservasiController extends Controller
{
    /**
     * Menyimpan data booking awal dengan status 'pending'.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'accommodation_id' => 'required|exists:accommodations,id',
                'pemesan_nama' => 'required|string|max:255',
                'pemesan_telp' => 'required|string|max:20',
                'pemesan_email' => 'required|email|max:255',
                'nama_tamu' => 'required|string|max:255',
                'check_in_date' => 'required|string',
                'malam' => 'required|integer|min:1',
                'tambahan_anak' => 'nullable|integer|min:0',
                'tambahan_dewasa' => 'nullable|integer|min:0',
                'total' => 'required',
                'metode_pembayaran' => 'nullable|string|max:255',
            ]);

            // Parsing tanggal check-in dari format Indonesia ke YYYY-MM-DD
            $checkInStr = $validated['check_in_date'];
            $checkInDate = $this->parseIndonesianDate($checkInStr);
            
            $malam = intval($validated['malam']);
            $checkOutDate = $checkInDate->copy()->addDays($malam);

            // Validasi Pencegahan Double Booking (Ketersediaan Slot Kamar)
            $accommodation = Accommodation::findOrFail($validated['accommodation_id']);
            $totalSlots = $accommodation->slot;

            // Loop untuk setiap malam dari check-in hingga check-out - 1 hari
            for ($d = $checkInDate->copy(); $d->lt($checkOutDate); $d->addDay()) {
                $currentDate = $d->format('Y-m-d');
                
                // Hitung booking aktif yang mengokupasi tanggal ini (abaikan failed dan refunded)
                $activeBookingsCount = Booking::where('accommodation_id', $accommodation->id)
                    ->whereNotIn('status', ['failed', 'refunded'])
                    ->where(function($query) use ($currentDate) {
                        $query->where('check_in_date', '<=', $currentDate)
                              ->where('check_out_date', '>', $currentDate);
                    })
                    ->count();

                if ($activeBookingsCount + 1 > $totalSlots) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Maaf, tipe akomodasi ' . $accommodation->judul . ' sudah penuh pada tanggal yang Anda pilih. Silakan pilih rentang tanggal lain.'
                    ], 400);
                }
            }

            // Membersihkan total harga (misal: "IDR 1.200.000" menjadi 1200000)
            $totalStr = str_replace(['IDR', '.', ',', ' '], '', $validated['total']);
            $total = floatval($totalStr);

            // Membuat No. Pesanan unik
            $noPesanan = 'LDH-' . strtoupper(substr(uniqid(), -6)) . rand(10, 99);

            $booking = Booking::create([
                'no_pesanan' => $noPesanan,
                'accommodation_id' => $validated['accommodation_id'],
                'pemesan_nama' => $validated['pemesan_nama'],
                'pemesan_telp' => $validated['pemesan_telp'],
                'pemesan_email' => $validated['pemesan_email'],
                'nama_tamu' => $validated['nama_tamu'],
                'check_in_date' => $checkInDate->format('Y-m-d'),
                'check_out_date' => $checkOutDate->format('Y-m-d'),
                'malam' => $malam,
                'tambahan_anak' => intval($validated['tambahan_anak'] ?? 0),
                'tambahan_dewasa' => intval($validated['tambahan_dewasa'] ?? 0),
                'total' => $total,
                'metode_pembayaran' => $validated['metode_pembayaran'] ?? 'pending',
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pemesanan berhasil dibuat di database MySQL',
                'booking' => [
                    'id' => $booking->id,
                    'no_pesanan' => $booking->no_pesanan,
                    'total' => $booking->total,
                    'created_at' => $booking->created_at->toIso8601String(),
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan pemesanan: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Memperbarui status pesanan (misal: 'pending' -> 'success').
     */
    public function updateStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'no_pesanan' => 'required|string|exists:bookings,no_pesanan',
                'status' => 'required|string|in:success,failed,pending,refund_pending,refunded,refund_rejected',
                'metode_pembayaran' => 'nullable|string',
            ]);

            $booking = Booking::where('no_pesanan', $validated['no_pesanan'])->firstOrFail();
            
            // Jangan izinkan menimpa status refund (refund_pending/refunded/refund_rejected) 
            // dengan success/failed dari auto-update halaman konfirmasi
            $refundStatuses = ['refund_pending', 'refunded', 'refund_rejected'];
            $incomingStatus = $validated['status'];
            if (in_array($booking->status, $refundStatuses) && in_array($incomingStatus, ['success', 'failed'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status tidak diubah karena booking sudah dalam proses refund.',
                    'booking' => $booking
                ]);
            }

            // Cek apakah booking bertransisi dari pending ke success (pembayaran pertama kali)
            $isTransitioning = ($booking->status === 'pending' && $validated['status'] === 'success');

            $booking->status = $validated['status'];
            if (!empty($validated['metode_pembayaran'])) {
                $booking->metode_pembayaran = $validated['metode_pembayaran'];
            }
            $booking->save();

            // Tindakan otomatis HANYA jika status berubah dari pending ke success
            if ($isTransitioning) {
                // 1. Generate PDF (Memory only)
                try {
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', ['booking' => $booking])->setPaper('a4', 'portrait');
                    $pdfContent = $pdf->output();
                } catch (\Exception $e) {
                    \Log::error('Gagal membuat PDF untuk pesanan ' . $booking->no_pesanan . ': ' . $e->getMessage());
                    $pdfContent = null;
                }

                // 2. Kirim E-Ticket via Email
                try {
                    \Illuminate\Support\Facades\Mail::to($booking->pemesan_email)->send(new \App\Mail\BookingSuccessMail($booking));
                } catch (\Exception $mailEx) {
                    \Log::error('Gagal mengirim email E-Ticket untuk pesanan ' . $booking->no_pesanan . ': ' . $mailEx->getMessage());
                }

                // 3. Kirim Konfirmasi WhatsApp via Fonnte
                try {
                    $token = env('FONNTE_TOKEN');
                    if (!empty($token)) {
                        $checkIn = \Carbon\Carbon::parse($booking->check_in_date)->locale('id')->isoFormat('dddd, D MMMM Y');
                        $checkOut = \Carbon\Carbon::parse($booking->check_out_date)->locale('id')->isoFormat('dddd, D MMMM Y');
                        $totalStr = number_format($booking->total, 0, ',', '.');
                        $invoiceUrl = url('/invoice/' . $booking->no_pesanan . '/download');
                        $akomodasiJudul = $booking->accommodation ? $booking->accommodation->judul : 'Akomodasi';

                        $message = "Halo, {$booking->pemesan_nama}!\n\n"
                                 . "Terima kasih telah melakukan pemesanan di *Landeuh Village Riverside*.\n\n"
                                 . "Pembayaran Anda untuk pesanan *{$booking->no_pesanan}* telah BERHASIL diverifikasi.\n\n"
                                 . "Detail Pesanan:\n"
                                 . "🏠 Akomodasi: {$akomodasiJudul}\n"
                                 . "📅 Check-in: {$checkIn}\n"
                                 . "🌙 Durasi: {$booking->malam} Malam\n"
                                 . "📅 Check-out: {$checkOut}\n"
                                 . "💰 Total: IDR {$totalStr}\n"
                                 . "💳 Metode: {$booking->metode_pembayaran}\n\n"
                                 . "Kebijakan\n"
                                 . "- Pemesanan ini tidak dapat diubah\n"
                                 . "- Pemesanan tidak ada refund jika Anda membatalkannya\n\n"
                                 . "Silakan unduh E-Ticket/Invoice Anda melalui link berikut:\n"
                                 . "👉 {$invoiceUrl}\n\n"
                                 . "Tunjukkan Invoice tersebut atau menyebutkan nomor pemesanan saat proses Check-in nanti.\n\n"
                                 . "Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami di nomor ini.\n\n"
                                 . "Salam hangat,\n"
                                 . "Tim Landeuh Village Riverside\n\n"
                                 . "> _Sent via fonnte.com_";

                        if ($pdfContent) {
                            \Illuminate\Support\Facades\Http::withHeaders([
                                'Authorization' => $token,
                            ])->attach('file', $pdfContent, 'Invoice_' . $booking->no_pesanan . '.pdf')
                            ->post('https://api.fonnte.com/send', [
                                'target' => $booking->pemesan_telp,
                                'message' => $message,
                            ]);
                        } else {
                            \Illuminate\Support\Facades\Http::withHeaders([
                                'Authorization' => $token,
                            ])->post('https://api.fonnte.com/send', [
                                'target' => $booking->pemesan_telp,
                                'message' => $message,
                            ]);
                        }
                    }
                } catch (\Exception $waEx) {
                    \Log::error('Gagal mengirim WhatsApp untuk pesanan ' . $booking->no_pesanan . ': ' . $waEx->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diverifikasi di MySQL',
                'booking' => $booking
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Download Invoice PDF.
     */
    public function downloadInvoice($no_pesanan)
    {
        $booking = Booking::with('accommodation')->where('no_pesanan', $no_pesanan)->firstOrFail();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', ['booking' => $booking])->setPaper('a4', 'portrait');
        return $pdf->download('Invoice_' . $booking->no_pesanan . '.pdf');
    }

    /**
     * Menghasilkan Snap Token khusus berdasarkan metode pembayaran yang dipilih.
     */
    public function getSnapToken(Request $request)
    {
        try {
            $validated = $request->validate([
                'no_pesanan' => 'required|string|exists:bookings,no_pesanan',
                'metode_pembayaran' => 'required|string',
            ]);

            $booking = Booking::with('accommodation')->where('no_pesanan', $validated['no_pesanan'])->firstOrFail();
            
            // Simpan metode pembayaran pilihan terbaru ke database
            $booking->metode_pembayaran = $validated['metode_pembayaran'];
            $booking->save();

            $serverKey = config('services.midtrans.server_key');
            $snapToken = null;
            $midtransError = null;

            if (!empty($serverKey) && $serverKey !== 'SB-Mid-server-YOUR_SERVER_KEY') {
                \Midtrans\Config::$serverKey = $serverKey;
                \Midtrans\Config::$isProduction = config('services.midtrans.is_production', false);
                \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized', true);
                \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds', true);

                $params = [
                    'transaction_details' => [
                        'order_id' => $booking->no_pesanan,
                        'gross_amount' => (int) $booking->total,
                    ],
                    'customer_details' => [
                        'first_name' => $booking->pemesan_nama,
                        'email' => $booking->pemesan_email,
                        'phone' => $booking->pemesan_telp,
                    ],
                ];

                // Pasang filter Enabled Payments khusus berdasarkan input metode dari frontend
                $enabledPayments = $this->getMidtransEnabledPayments($validated['metode_pembayaran']);
                if (!empty($enabledPayments)) {
                    $params['enabled_payments'] = $enabledPayments;
                }

                $snapToken = \Midtrans\Snap::getSnapToken($params);
            }

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'midtrans_error' => $midtransError,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan Snap Token: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Memetakan nama metode pembayaran dari frontend ke filter enabled_payments Midtrans Snap.
     */
    private function getMidtransEnabledPayments($methodName)
    {
        $methodName = strtolower($methodName);
        
        if (str_contains($methodName, 'bca')) {
            return ['bca_va'];
        }
        if (str_contains($methodName, 'mandiri')) {
            return ['echannel']; // Mandiri Bill Payment / E-Channel
        }
        if (str_contains($methodName, 'bri')) {
            return ['bri_va'];
        }
        if (str_contains($methodName, 'bni')) {
            return ['bni_va'];
        }
        if (str_contains($methodName, 'bsi')) {
            return ['bsi_va'];
        }
        if (str_contains($methodName, 'qris')) {
            return ['qris', 'gopay', 'shopeepay'];
        }
        if (str_contains($methodName, 'dana') || str_contains($methodName, 'gopay') || str_contains($methodName, 'ovo') || str_contains($methodName, 'shopeepay') || str_contains($methodName, 'wallet')) {
            return ['qris', 'gopay', 'shopeepay']; // QRIS supports e-wallets
        }
        if (str_contains($methodName, 'alfamart')) {
            return ['alfamart'];
        }
        if (str_contains($methodName, 'indomaret')) {
            return ['indomaret'];
        }
        if (str_contains($methodName, 'atm')) {
            return ['other_va'];
        }
        if (str_contains($methodName, 'kartu kredit') || str_contains($methodName, 'credit card') || str_contains($methodName, 'cc')) {
            return ['credit_card'];
        }
        
        return []; // Jika kosong, tampilkan semua
    }

    /**
     * Helper untuk parsing string tanggal Indonesia (misal: "Selasa, 28 April 2026") menjadi Carbon.
     */
    private function parseIndonesianDate($dateStr)
    {
        // Hilangkan nama hari jika ada (misal: "Selasa, 28 April 2026" -> "28 April 2026")
        if (str_contains($dateStr, ',')) {
            $parts = explode(',', $dateStr);
            $dateStr = trim($parts[1]);
        }

        $months = [
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03', 'April' => '04',
            'Mei' => '05', 'Juni' => '06', 'Juli' => '07', 'Agustus' => '08',
            'September' => '09', 'Oktober' => '10', 'November' => '11', 'Desember' => '12'
        ];

        // Ubah nama bulan Indonesia ke angka
        foreach ($months as $indo => $num) {
            if (str_contains($dateStr, $indo)) {
                $dateStr = str_replace($indo, $num, $dateStr);
                break;
            }
        }

        // Pecah string "28 04 2026"
        $dateParts = explode(' ', $dateStr);
        if (count($dateParts) === 3) {
            $day = str_pad($dateParts[0], 2, '0', STR_PAD_LEFT);
            $month = str_pad($dateParts[1], 2, '0', STR_PAD_LEFT);
            $year = $dateParts[2];
            return Carbon::createFromFormat('Y-m-d', "$year-$month-$day");
        }

        return Carbon::parse($dateStr);
    }
}
