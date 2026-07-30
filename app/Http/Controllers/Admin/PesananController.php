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

    public function forceReschedule(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'check_in_date' => 'required|date',
                'check_out_date' => 'required|date|after:check_in_date',
            ]);

            $booking = Booking::findOrFail($validated['booking_id']);
            
            $bIn = \Carbon\Carbon::parse($validated['check_in_date']);
            $bOut = \Carbon\Carbon::parse($validated['check_out_date']);
            $nights = $bIn->diffInDays($bOut);

            // Backend Availability Validation
            $isCorporate = !is_null($booking->corporate_package_id);
            if ($isCorporate) {
                $target = \App\Models\CorporatePackage::findOrFail($booking->corporate_package_id);
                $totalSlots = 1; // Max 1 booking per day for corporate packages
            } else {
                $target = \App\Models\Accommodation::findOrFail($booking->accommodation_id);
                $totalSlots = $target->slot;
            }

            for ($d = $bIn->copy(); $d->lt($bOut); $d->addDay()) {
                $currentDate = $d->format('Y-m-d');

                if ($isCorporate) {
                    $count = Booking::where('corporate_package_id', $target->id)
                        ->where('id', '!=', $booking->id)
                        ->whereNotIn('status', ['failed', 'refunded'])
                        ->where('check_in_date', '<=', $currentDate)
                        ->where('check_out_date', '>', $currentDate)
                        ->count();

                    if ($count >= $totalSlots) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Maaf, tanggal ' . $currentDate . ' sudah penuh/terdapat reservasi lain untuk paket corporate ini.'
                        ], 400);
                    }
                } else {
                    $count = Booking::where('accommodation_id', $target->id)
                        ->where('id', '!=', $booking->id)
                        ->whereNotIn('status', ['failed', 'refunded'])
                        ->where('check_in_date', '<=', $currentDate)
                        ->where('check_out_date', '>', $currentDate)
                        ->count();

                    if ($count >= $totalSlots) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Maaf, tanggal ' . $currentDate . ' sudah penuh/terdapat reservasi lain untuk kamar ini.'
                        ], 400);
                    }

                    // Check if package of this type is booked on this date
                    $accomJenis = $target->jenis;
                    if ($accomJenis === 'Glamping' || $accomJenis === 'Cabin') {
                        $corpBooked = Booking::whereHas('corporatePackage', function($q) use ($accomJenis) {
                                $q->where('jenis_akomodasi', $accomJenis);
                            })
                            ->where('id', '!=', $booking->id)
                            ->whereNotIn('status', ['failed', 'refunded'])
                            ->where('check_in_date', '<=', $currentDate)
                            ->where('check_out_date', '>', $currentDate)
                            ->exists();
                        if ($corpBooked) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Maaf, tanggal ' . $currentDate . ' sudah di-booking oleh paket corporate.'
                            ], 400);
                        }
                    }
                }

                // Check global libur
                $isLibur = \App\Models\DateSetting::where('type', 'libur_landeuh')
                    ->where('dates', 'like', '%' . $currentDate . '%')
                    ->exists();
                if ($isLibur) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Maaf, tanggal ' . $currentDate . ' diliburkan (Libur Global).'
                    ], 400);
                }

                // Check specific blocked dates
                $blockedPeriods = $target->blocked_dates ?? [];
                foreach ($blockedPeriods as $bp) {
                    if (!empty($bp['dates']) && str_contains($bp['dates'], $currentDate)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Maaf, tanggal ' . $currentDate . ' diliburkan untuk kamar/paket ini.'
                        ], 400);
                    }
                }

                // If accommodation, check if parent package is blocked
                if (!$isCorporate) {
                    $relatedCorpBlocked = \App\Models\CorporatePackage::get()
                        ->filter(function($cp) use ($target) {
                            return in_array($target->id, $cp->accommodation_ids ?? []);
                        })
                        ->pluck('blocked_dates')
                        ->filter()
                        ->flatten(1)
                        ->toArray();
                    foreach ($relatedCorpBlocked as $rcb) {
                        if (!empty($rcb['dates']) && str_contains($rcb['dates'], $currentDate)) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Maaf, tanggal ' . $currentDate . ' diliburkan karena paket terkait diliburkan.'
                            ], 400);
                        }
                    }
                }
            }

            $booking->check_in_date = $bIn->format('Y-m-d');
            $booking->check_out_date = $bOut->format('Y-m-d');
            $booking->malam = $nights;
            $booking->save();

            \App\Models\ActivityLog::log("Melakukan Force Reschedule pesanan #" . $booking->no_pesanan . " ke tanggal " . $booking->check_in_date . " s/d " . $booking->check_out_date);

            // Regenerate PDF invoice
            try {
                $invoiceName = 'Invoice_' . $booking->no_pesanan . '.pdf';
                $pdfPath = public_path('invoices/' . $invoiceName);
                if (class_exists('\Barryvdh\DomPDF\Facade\Pdf')) {
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', ['booking' => $booking])->setPaper('a4', 'portrait');
                    $pdf->save($pdfPath);
                }
            } catch (\Exception $pdfEx) {
                \Log::error('Failed to regenerate PDF on force reschedule: ' . $pdfEx->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Tanggal booking berhasil diubah oleh Admin.',
                'booking' => $booking
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah tanggal: ' . $e->getMessage()
            ], 400);
        }
    }
}
