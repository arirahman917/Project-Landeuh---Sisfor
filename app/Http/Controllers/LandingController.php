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
            $query->where('status', '!=', 'failed');
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

        return view('akomodasi.akomodasi_detail', compact('accommodations', 'dateSettings'));
    }
}
