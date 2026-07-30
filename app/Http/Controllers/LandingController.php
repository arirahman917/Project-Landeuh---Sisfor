<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Get the top 3 accommodations. You can customize the sorting (e.g. by highest rating or most booked)
        $populerAccommodations = Accommodation::take(3)->get();
        
        return view('landing.index', compact('populerAccommodations'));
    }

    public function akomodasi()
    {
        $accommodations = Accommodation::with(['bookings' => function($query) {
                $query->whereNotIn('status', ['failed', 'refunded']);
            }])->get();
        $dateSettings = \App\Models\DateSetting::all();

        // Load all active corporate package bookings grouped by jenis_akomodasi
        $corporateBookings = \App\Models\Booking::whereNotNull('corporate_package_id')
            ->whereNotIn('status', ['failed', 'refunded'])
            ->with('corporatePackage:id,jenis_akomodasi,accommodation_ids')
            ->get(['id', 'corporate_package_id', 'check_in_date', 'check_out_date', 'status']);

        // Build a map: jenis_akomodasi → array of {check_in_date, check_out_date}
        $corpDatesByJenis = [];
        foreach ($corporateBookings as $cb) {
            $pkg = $cb->corporatePackage;
            if (!$pkg || !$pkg->jenis_akomodasi) continue;
            $jenis = $pkg->jenis_akomodasi;
            if (!isset($corpDatesByJenis[$jenis])) $corpDatesByJenis[$jenis] = [];
            $corpDatesByJenis[$jenis][] = [
                'check_in_date'  => is_object($cb->check_in_date) ? $cb->check_in_date->format('Y-m-d\TH:i:s.000000\Z') : $cb->check_in_date,
                'check_out_date' => is_object($cb->check_out_date) ? $cb->check_out_date->format('Y-m-d\TH:i:s.000000\Z') : $cb->check_out_date,
                'status'         => 'success', // treat as active for JS
            ];
        }

        $corpPackages = \App\Models\CorporatePackage::all();

        $accommodations->transform(function ($item) use ($corpDatesByJenis, $corpPackages) {
            $item->hargaWeekday    = $item->harga_weekday;
            $item->hargaWeekend    = $item->harga_weekend;
            $item->hargaHighseason = $item->harga_highseason;
            $item->maxOrang        = $item->max_orang;

            $myBlockedDates = $item->blocked_dates ?: [];
            foreach ($corpPackages as $cp) {
                if (in_array($item->id, $cp->accommodation_ids ?? [])) {
                    $cpBlocked = $cp->blocked_dates ?: [];
                    $myBlockedDates = array_merge($myBlockedDates, $cpBlocked);
                }
            }
            $item->blocked_dates = $myBlockedDates;

            // Inject corporate bookings: if there's a corp booking for this jenis,
            // those dates should count as the FULL slot being occupied.
            // We do this by injecting fake bookings with slot count equal to item->slot.
            $jenis = $item->jenis;
            if (isset($corpDatesByJenis[$jenis]) && count($corpDatesByJenis[$jenis]) > 0) {
                $existingBookings = $item->bookings->toArray();
                foreach ($corpDatesByJenis[$jenis] as $cb) {
                    // Add enough "fake" bookings to fill all slots
                    for ($i = 0; $i < $item->slot; $i++) {
                        $existingBookings[] = [
                            'check_in_date'  => $cb['check_in_date'],
                            'check_out_date' => $cb['check_out_date'],
                            'status'         => 'success',
                        ];
                    }
                }
                $item->setRelation('bookings', collect($existingBookings));
            }

            $bookedDates = $item->bookings->map(function ($booking) {
                $cin  = is_array($booking) ? $booking['check_in_date']  : $booking->check_in_date;
                $cout = is_array($booking) ? $booking['check_out_date'] : $booking->check_out_date;
                return (is_object($cin) ? $cin->format('Y-m-d') : substr($cin, 0, 10))
                    . ' -> '
                    . (is_object($cout) ? $cout->format('Y-m-d') : substr($cout, 0, 10));
            });
            $item->bookedDates = $bookedDates;

            return $item;
        });

        return view('akomodasi.akomodasi_detail', compact('accommodations', 'dateSettings'));
    }

    public function corporate()
    {
        $accommodations = \App\Models\CorporatePackage::with(['bookings' => function($query) {
                $query->whereNotIn('status', ['failed', 'refunded']);
            }])->get();
            
        $dateSettings = \App\Models\DateSetting::all();
        
        $accommodations->transform(function ($item) {
            $bookedDates = $item->bookings->map(function ($booking) {
                return $booking->check_in_date->format('Y-m-d') . ' -> ' . $booking->check_out_date->format('Y-m-d');
            });
            $item->bookedDates = $bookedDates;
            // Map keys for JS compatibility
            $item->hargaWeekday = $item->harga_weekday;
            $item->hargaWeekend = $item->harga_weekend;
            $item->hargaHighseason = $item->harga_highseason;
            $item->maxOrang = $item->max_orang;
            return $item;
        });

        // Get all individual bookings (non-corporate) that are active
        $individualBookings = \App\Models\Booking::whereNotNull('accommodation_id')
          ->whereNotIn('status', ['failed', 'refunded'])
          ->get(['id', 'accommodation_id', 'check_in_date', 'check_out_date', 'status']);

        // Build a per-package map: package_id → filtered individual bookings
        // Only include bookings for units that are in the package's accommodation_ids
        $indBookingsPerPackage = [];
        foreach ($accommodations as $pkg) {
            $pkgAccomIds = is_array($pkg->accommodation_ids) ? $pkg->accommodation_ids : [];
            $pkgAccomIds = array_map('intval', $pkgAccomIds);
            $indBookingsPerPackage[$pkg->id] = $individualBookings->filter(function($b) use ($pkgAccomIds) {
                return in_array((int) $b->accommodation_id, $pkgAccomIds);
            })->values();
        }

        return view('akomodasi.corporate', compact('accommodations', 'dateSettings', 'indBookingsPerPackage'));
    }
}
