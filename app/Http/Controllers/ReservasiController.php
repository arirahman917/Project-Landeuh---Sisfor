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
                'accommodation_id' => 'nullable|exists:accommodations,id',
                'corporate_package_id' => 'nullable|exists:corporate_packages,id',
                'pemesan_nama' => 'required|string|max:255',
                'pemesan_telp' => 'required|string|max:20',
                'pemesan_email' => 'required|email|max:255',
                'nama_tamu' => 'required|string|max:255',
                'check_in_date' => 'required|string',
                'malam' => 'required|integer|min:1',
                'tambahan_anak' => 'nullable|integer|min:0',
                'tambahan_dewasa' => 'nullable|integer|min:0',
                'jumlah_pax' => 'nullable|integer|min:25|max:150',
                'total' => 'required',
                'metode_pembayaran' => 'nullable|string|max:255',
            ]);

            if (empty($validated['accommodation_id']) && empty($validated['corporate_package_id'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Harus memilih akomodasi atau paket corporate.'
                ], 400);
            }

            $isCorporate = !empty($validated['corporate_package_id']);

            // Parsing tanggal check-in dari format Indonesia ke YYYY-MM-DD
            $checkInStr = $validated['check_in_date'];
            $checkInDate = $this->parseIndonesianDate($checkInStr);
            
            $malam = intval($validated['malam']);
            $checkOutDate = $checkInDate->copy()->addDays($malam);

            // Validasi Pencegahan Double Booking (Ketersediaan Slot Kamar)
            if ($isCorporate) {
                $target = \App\Models\CorporatePackage::findOrFail($validated['corporate_package_id']);
            } else {
                $target = Accommodation::findOrFail($validated['accommodation_id']);
            }
            $totalSlots = $target->slot;

            // Loop untuk setiap malam dari check-in hingga check-out - 1 hari
            for ($d = $checkInDate->copy(); $d->lt($checkOutDate); $d->addDay()) {
                $currentDate = $d->format('Y-m-d');
                $isAvailable = true;
                
                if ($isCorporate) {
                    // Cek ketersediaan untuk paket corporate
                    $corpBookingsCount = Booking::where('corporate_package_id', $target->id)
                        ->whereNotIn('status', ['failed', 'refunded'])
                        ->where(function($query) use ($currentDate) {
                            $query->where('check_in_date', '<=', $currentDate)
                                  ->where('check_out_date', '>', $currentDate);
                        })
                        ->count();

                    if ($corpBookingsCount + 1 > $totalSlots) {
                        $isAvailable = false;
                    } else {
                        // Cek apakah seluruh unit reguler (misal: 13 Glamping atau 8 Cabin) sudah habis dibooking
                        $targetJenis = $target->jenis_akomodasi ?? '';
                        if ($targetJenis) {
                            $maxUnits = Accommodation::where('jenis', $targetJenis)->sum('slot') ?: (strtolower($targetJenis) === 'glamping' ? 13 : 8);
                            $regularBookedCount = Booking::whereHas('accommodation', function($q) use ($targetJenis) {
                                    $q->where('jenis', $targetJenis);
                                })
                                ->whereNotIn('status', ['failed', 'refunded'])
                                ->where('check_in_date', '<=', $currentDate)
                                ->where('check_out_date', '>', $currentDate)
                                ->count();
                            if ($regularBookedCount >= $maxUnits) $isAvailable = false;
                        }
                    }
                } else {
                    // Cek ketersediaan untuk akomodasi reguler
                    $activeBookingsCount = Booking::where('accommodation_id', $target->id)
                        ->whereNotIn('status', ['failed', 'refunded'])
                        ->where(function($query) use ($currentDate) {
                            $query->where('check_in_date', '<=', $currentDate)
                                  ->where('check_out_date', '>', $currentDate);
                        })
                        ->count();
                    
                    if ($activeBookingsCount + 1 > $totalSlots) {
                        $isAvailable = false;
                    } else {
                        // Cek apakah ada paket corporate yang membooking unit jenis ini (via jenis_akomodasi)
                        $accomJenis = $target->jenis;
                        $corpBooked = Booking::whereHas('corporatePackage', function($q) use ($accomJenis) {
                                $q->where('jenis_akomodasi', $accomJenis);
                            })
                            ->whereNotIn('status', ['failed', 'refunded'])
                            ->where('check_in_date', '<=', $currentDate)
                            ->where('check_out_date', '>', $currentDate)
                            ->exists();
                        if ($corpBooked) $isAvailable = false;
                    }
                }

                if (!$isAvailable) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Maaf, tipe akomodasi/paket ' . $target->judul . ' sudah penuh/terdapat reservasi lain pada tanggal yang Anda pilih.'
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
                'accommodation_id' => $isCorporate ? null : $validated['accommodation_id'],
                'corporate_package_id' => $isCorporate ? $validated['corporate_package_id'] : null,
                'pemesan_nama' => $validated['pemesan_nama'],
                'pemesan_telp' => $validated['pemesan_telp'],
                'pemesan_email' => $validated['pemesan_email'],
                'nama_tamu' => $validated['nama_tamu'],
                'check_in_date' => $checkInDate->format('Y-m-d'),
                'check_out_date' => $checkOutDate->format('Y-m-d'),
                'malam' => $malam,
                'jumlah_pax' => isset($validated['jumlah_pax']) ? intval($validated['jumlah_pax']) : null,
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
                'status' => 'required|string|in:success,failed,pending,refund_pending,refunded,refund_rejected,reschedule_pending,rescheduled,reschedule_rejected',
                'metode_pembayaran' => 'nullable|string',
            ]);

            $booking = Booking::where('no_pesanan', $validated['no_pesanan'])->firstOrFail();
            
            // Jangan izinkan menimpa status refund/reschedule
            $protectedStatuses = ['refund_pending', 'refunded', 'refund_rejected', 'reschedule_pending', 'rescheduled', 'reschedule_rejected'];
            $incomingStatus = $validated['status'];
            if (in_array($booking->status, $protectedStatuses) && in_array($incomingStatus, ['success', 'failed'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status tidak diubah karena booking sudah dalam proses refund/reschedule.',
                    'booking' => $booking
                ]);
            }

            if ($booking->status === 'failed' && $incomingStatus === 'success') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran ditolak karena pesanan telah dibatalkan (melewati batas waktu).',
                    'booking' => $booking
                ], 400);
            }

            // Cek apakah booking bertransisi dari pending ke success (pembayaran pertama kali)
            $isTransitioning = ($booking->status === 'pending' && $validated['status'] === 'success');
            
            \Log::info('updateStatus called', [
                'no_pesanan' => $booking->no_pesanan,
                'old_status' => $booking->status,
                'new_status' => $validated['status'],
                'isTransitioning' => $isTransitioning,
                'email' => $booking->pemesan_email,
            ]);

            $booking->status = $validated['status'];
            if (!empty($validated['metode_pembayaran'])) {
                $booking->metode_pembayaran = $validated['metode_pembayaran'];
            }

            // Jika admin menerima reschedule, swap tanggal
            if ($validated['status'] === 'rescheduled' && $booking->reschedule_check_in && $booking->reschedule_check_out) {
                $booking->check_in_date = $booking->reschedule_check_in;
                $booking->check_out_date = $booking->reschedule_check_out;
                // Clear reschedule fields setelah swap
                $booking->reschedule_check_in = null;
                $booking->reschedule_check_out = null;
            }

            $booking->save();

            // Tindakan otomatis HANYA jika status berubah dari pending ke success
            if ($isTransitioning) {
                // 1. Generate PDF (Memory only)
                try {
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', ['booking' => $booking])->setPaper('a4', 'portrait');
                    $pdfContent = $pdf->output();
                    \Log::info('PDF generated for ' . $booking->no_pesanan);
                } catch (\Exception $e) {
                    \Log::error('Gagal membuat PDF untuk pesanan ' . $booking->no_pesanan . ': ' . $e->getMessage());
                    $pdfContent = null;
                }

                // 2. Kirim E-Ticket via Email
                try {
                    \Illuminate\Support\Facades\Mail::to($booking->pemesan_email)->send(new \App\Mail\BookingSuccessMail($booking, $pdfContent));
                    \Log::info('Email E-Ticket SENT for ' . $booking->no_pesanan . ' to ' . $booking->pemesan_email);
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
                        $akomodasiJudul = $booking->accommodation ? $booking->accommodation->judul : ($booking->corporatePackage ? $booking->corporatePackage->judul : 'Akomodasi');

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
                                 . "Tim Landeuh Village Riverside";

                        \Illuminate\Support\Facades\Http::withHeaders([
                            'Authorization' => $token,
                        ])->post('https://api.fonnte.com/send', [
                            'target' => $booking->pemesan_telp,
                            'message' => $message,
                        ]);
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
        $booking = Booking::with(['accommodation', 'corporatePackage'])->where('no_pesanan', $no_pesanan)->firstOrFail();
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

            $booking = Booking::with(['accommodation', 'corporatePackage'])->where('no_pesanan', $validated['no_pesanan'])->firstOrFail();
            
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

                $itemTitle = $booking->corporatePackage 
                    ? $booking->corporatePackage->judul 
                    : ($booking->accommodation ? $booking->accommodation->judul : 'Akomodasi Landeuh');

                $params = [
                    'transaction_details' => [
                        'order_id' => $booking->no_pesanan . '-' . time(),
                        'gross_amount' => (int) $booking->total,
                    ],
                    'item_details' => [
                        [
                            'id' => 'BOOKING-' . $booking->id,
                            'price' => (int) $booking->total,
                            'quantity' => 1,
                            'name' => mb_strimwidth($itemTitle, 0, 50, '...'),
                        ]
                    ],
                    'customer_details' => [
                        'first_name' => $booking->pemesan_nama,
                        'email' => $booking->pemesan_email,
                        'phone' => $booking->pemesan_telp,
                    ],
                ];

                // Pasang filter Enabled Payments khusus berdasarkan input metode dari frontend
                // $enabledPayments = $this->getMidtransEnabledPayments($validated['metode_pembayaran']);
                // if (!empty($enabledPayments)) {
                //     $params['enabled_payments'] = $enabledPayments;
                // }

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

    /**
     * Submit reschedule request dari user.
     */
    public function submitReschedule(Request $request)
    {
        try {
            $validated = $request->validate([
                'no_pesanan' => 'required|string|exists:bookings,no_pesanan',
                'new_check_in' => 'required|date',
            ]);

            $booking = Booking::with(['accommodation', 'corporatePackage'])->where('no_pesanan', $validated['no_pesanan'])->firstOrFail();

            // Hanya booking 'success' yang boleh reschedule
            if ($booking->status !== 'success') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya pesanan berstatus sukses/lunas yang dapat diajukan reschedule.'
                ], 400);
            }

            // Cek H-3: minimal 3 hari sebelum check-in asli
            $now = Carbon::now()->startOfDay();
            $originalCheckin = Carbon::parse($booking->check_in_date)->startOfDay();
            $diffDays = $now->diffInDays($originalCheckin, false);

            if ($diffDays < 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan reschedule hanya bisa dilakukan minimal H-3 sebelum tanggal check-in.'
                ], 400);
            }

            // Hitung tipe tanggal untuk check-in asli dan check-in baru
            $settings = \App\Models\DateSetting::all();
            $originalType = $this->getDateType($booking->check_in_date, $settings);
            $newType = $this->getDateType($validated['new_check_in'], $settings);

            if ($originalType !== $newType) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan reschedule ditolak. Anda hanya dapat memindahkan jadwal ke tipe hari yang sama (' . ucfirst($originalType) . ').'
                ], 400);
            }

            // Hitung check-out baru berdasarkan malam yang sama
            $newCheckIn = Carbon::parse($validated['new_check_in']);
            $newCheckOut = $newCheckIn->copy()->addDays($booking->malam);

            // Validasi ketersediaan
            $isCorporate = !empty($booking->corporate_package_id);
            $target = $isCorporate ? $booking->corporatePackage : $booking->accommodation;
            $totalSlots = $target->slot;

            for ($d = $newCheckIn->copy(); $d->lt($newCheckOut); $d->addDay()) {
                $currentDate = $d->format('Y-m-d');
                $isAvailable = true;

                if ($isCorporate) {
                    $corpBookingsCount = Booking::where('corporate_package_id', $target->id)
                        ->whereNotIn('status', ['failed', 'refunded'])
                        ->where('id', '!=', $booking->id)
                        ->where(function($query) use ($currentDate) {
                            $query->where('check_in_date', '<=', $currentDate)
                                  ->where('check_out_date', '>', $currentDate);
                        })
                        ->count();

                    if ($corpBookingsCount + 1 > $totalSlots) {
                        $isAvailable = false;
                    } else {
                        $targetJenis = $target->jenis_akomodasi ?? '';
                        if ($targetJenis) {
                            $maxUnits = Accommodation::where('jenis', $targetJenis)->sum('slot') ?: (strtolower($targetJenis) === 'glamping' ? 13 : 8);
                            $regularBookedCount = Booking::whereHas('accommodation', function($q) use ($targetJenis) {
                                    $q->where('jenis', $targetJenis);
                                })
                                ->whereNotIn('status', ['failed', 'refunded'])
                                ->where('id', '!=', $booking->id)
                                ->where('check_in_date', '<=', $currentDate)
                                ->where('check_out_date', '>', $currentDate)
                                ->count();
                            if ($regularBookedCount >= $maxUnits) $isAvailable = false;
                        }
                    }
                } else {
                    $activeBookingsCount = Booking::where('accommodation_id', $target->id)
                        ->whereNotIn('status', ['failed', 'refunded'])
                        ->where('id', '!=', $booking->id)
                        ->where(function($query) use ($currentDate) {
                            $query->where('check_in_date', '<=', $currentDate)
                                  ->where('check_out_date', '>', $currentDate);
                        })
                        ->count();

                    if ($activeBookingsCount + 1 > $totalSlots) {
                        $isAvailable = false;
                    } else {
                        $accomJenis = $target->jenis;
                        $corpBooked = Booking::whereHas('corporatePackage', function($q) use ($accomJenis) {
                                $q->where('jenis_akomodasi', $accomJenis);
                            })
                            ->whereNotIn('status', ['failed', 'refunded'])
                            ->where('check_in_date', '<=', $currentDate)
                            ->where('check_out_date', '>', $currentDate)
                            ->exists();
                        if ($corpBooked) $isAvailable = false;
                    }
                }

                if (!$isAvailable) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Maaf, tanggal yang Anda pilih sudah penuh atau terkunci oleh reservasi lain.'
                    ], 400);
                }
            }

            // Update booking
            $booking->reschedule_check_in = $newCheckIn->format('Y-m-d');
            $booking->reschedule_check_out = $newCheckOut->format('Y-m-d');
            $booking->status = 'reschedule_pending';
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan reschedule berhasil dikirim. Menunggu persetujuan admin.',
                'booking' => $booking
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengajukan reschedule: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get booked dates for a specific accommodation (for datepicker).
     */
    public function getBookedDates(Request $request, $id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $totalSlots = $accommodation->slot;

        // Ambil semua booking aktif untuk akomodasi ini
        $bookings = Booking::where('accommodation_id', $id)
            ->whereNotIn('status', ['failed', 'refunded'])
            ->get();

        // Exclude booking_id jika disediakan (supaya booking yg sedang di-reschedule tidak menghitung dirinya)
        $excludeId = $request->query('exclude_booking_id');

        // Scan 365 hari ke depan
        $bookedDates = [];
        $startDate = Carbon::now()->startOfDay();
        $endDate = $startDate->copy()->addDays(365);

        for ($d = $startDate->copy(); $d->lte($endDate); $d->addDay()) {
            $currentDate = $d->format('Y-m-d');

            $count = $bookings->filter(function($b) use ($currentDate, $excludeId) {
                if ($excludeId && $b->id == $excludeId) return false;
                return $b->check_in_date->format('Y-m-d') <= $currentDate
                    && $b->check_out_date->format('Y-m-d') > $currentDate;
            })->count();
            
            $isBooked = false;

            $accomJenis = $accommodation->jenis;
            if ($accomJenis === 'Glamping' || $accomJenis === 'Cabin') {
                $corpBooked = Booking::whereHas('corporatePackage', function($q) use ($accomJenis) {
                        $q->where('jenis_akomodasi', $accomJenis);
                    })
                    ->whereNotIn('status', ['failed', 'refunded'])
                    ->when($excludeId, function($q) use ($excludeId) {
                        return $q->where('id', '!=', $excludeId);
                    })
                    ->where('check_in_date', '<=', $currentDate)
                    ->where('check_out_date', '>', $currentDate)
                    ->count();
                if ($corpBooked > 0 || $count >= $totalSlots) $isBooked = true;
            } else {
                if ($count >= $totalSlots) $isBooked = true;
            }

            if ($isBooked) {
                $bookedDates[] = $currentDate;
            }
        }

        return response()->json([
            'success' => true,
            'booked_dates' => $bookedDates,
            'slot' => $totalSlots,
            'date_settings' => \App\Models\DateSetting::all()
        ]);
    }

    /**
     * Helper untuk menentukan tipe tanggal (highseason, weekend, weekday)
     */
    private function getDateType($dateString, $settings)
    {
        $date = Carbon::parse($dateString);
        $dateStr = $date->format('Y-m-d');
        
        $daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
        $dayName = $daysIndo[$date->dayOfWeek];

        // 1. Check Highseason
        $hsSettings = $settings->where('type', 'highseason');
        foreach ($hsSettings as $hs) {
            if ($hs->dates && str_contains($hs->dates, $dateStr)) {
                return 'highseason';
            }
        }

        // 2. Check Weekend
        $weSetting = $settings->where('type', 'weekend')->first();
        if ($weSetting && $weSetting->dates) {
            if (str_contains($weSetting->dates, $dateStr) || str_contains($weSetting->dates, $dayName)) {
                return 'weekend';
            }
        }

        return 'weekday';
    }
}
