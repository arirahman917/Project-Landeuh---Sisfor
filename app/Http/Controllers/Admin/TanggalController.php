<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DateSetting;

class TanggalController extends Controller
{
    public function index()
    {
        $settings = DateSetting::all();
        
        $weekday = $settings->where('type', 'weekday')->first();
        $weekend = $settings->where('type', 'weekend')->first();
        $highseason = $settings->where('type', 'highseason')->values();
        $liburLandeuh = $settings->where('type', 'libur_landeuh')->values();

        return view('admin.tanggal.index', compact('weekday', 'weekend', 'highseason', 'liburLandeuh'));
    }

    public function updateAll(Request $request)
    {
        // Receive the full TANGGAL_DATA JSON from the frontend
        $data = $request->json()->all();

        // Update Weekday
        DateSetting::updateOrCreate(
            ['type' => 'weekday'],
            ['name' => 'Weekday', 'dates' => $data['weekday']['dates'] ?? '']
        );

        // Update Weekend
        DateSetting::updateOrCreate(
            ['type' => 'weekend'],
            ['name' => 'Weekend', 'dates' => $data['weekend']['dates'] ?? '']
        );

        // Sync Highseason
        DateSetting::where('type', 'highseason')->delete();

        if (isset($data['highseason']) && is_array($data['highseason'])) {
            foreach ($data['highseason'] as $hs) {
                if (!empty($hs['name']) || !empty($hs['dates'])) {
                    DateSetting::create([
                        'type' => 'highseason',
                        'name' => $hs['name'] ?? 'Periode Baru',
                        'dates' => $hs['dates'] ?? '',
                    ]);
                }
            }
        }

        // Sync Libur Landeuh
        DateSetting::where('type', 'libur_landeuh')->delete();

        if (isset($data['libur_landeuh']) && is_array($data['libur_landeuh'])) {
            foreach ($data['libur_landeuh'] as $ll) {
                if (!empty($ll['name']) || !empty($ll['dates'])) {
                    DateSetting::create([
                        'type' => 'libur_landeuh',
                        'name' => $ll['name'] ?? 'Periode Libur',
                        'dates' => $ll['dates'] ?? '',
                    ]);
                }
            }
        }

        \App\Models\ActivityLog::log("Memperbarui pengaturan kalender & libur global (Weekday, Weekend, Highseason, Libur Landeuh)");

        return response()->json(['message' => 'Tanggal berhasil diperbarui']);
    }

    public function checkConflicts(Request $request)
    {
        $datesInput = $request->input('dates');
        $accommodationIds = $request->input('accommodation_ids');
        $corporatePackageIds = $request->input('corporate_package_ids');

        if (is_string($datesInput)) {
            $targetDates = array_map('trim', explode(',', $datesInput));
        } else {
            $targetDates = (array) $datesInput;
        }
        $targetDates = array_filter($targetDates);

        if (empty($targetDates)) {
            return response()->json(['conflicts' => []]);
        }

        $query = \App\Models\Booking::with(['accommodation', 'corporatePackage'])
            ->whereNotIn('status', ['failed', 'refunded']);

        if (!empty($accommodationIds) || !empty($corporatePackageIds)) {
            $query->where(function($q) use ($accommodationIds, $corporatePackageIds) {
                // If checking specific rooms
                if (!empty($accommodationIds)) {
                    $q->orWhereIn('accommodation_id', $accommodationIds);
                }

                // If checking specific packages
                if (!empty($corporatePackageIds)) {
                    $accomIdsOfPackages = \App\Models\CorporatePackage::whereIn('id', $corporatePackageIds)
                        ->get()
                        ->pluck('accommodation_ids')
                        ->filter()
                        ->flatten(1)
                        ->unique()
                        ->toArray();

                    $q->orWhereIn('corporate_package_id', $corporatePackageIds);
                    if (!empty($accomIdsOfPackages)) {
                        $q->orWhereIn('accommodation_id', $accomIdsOfPackages);
                    }
                }
            });
        }

        $bookings = $query->get();

        $conflicts = [];
        foreach ($bookings as $b) {
            $bIn = $b->check_in_date;
            $bOut = $b->check_out_date;

            foreach ($targetDates as $dateStr) {
                try {
                    $t = \Carbon\Carbon::parse($dateStr);
                } catch (\Exception $e) {
                    continue;
                }

                if ($t->greaterThanOrEqualTo($bIn) && $t->lessThan($bOut)) {
                    $isCorporate = !is_null($b->corporate_package_id);
                    $akomodasiLabel = $isCorporate 
                        ? ($b->corporatePackage ? $b->corporatePackage->judul : 'Paket Corporate')
                        : ($b->accommodation ? $b->accommodation->judul : 'Kamar');

                    $conflicts[$b->id] = [
                        'id' => $b->id,
                        'noPesanan' => $b->no_pesanan,
                        'pemesanNama' => $b->pemesan_nama,
                        'pemesanTelp' => $b->pemesan_telp,
                        'pemesanEmail' => $b->pemesan_email,
                        'namaTamu' => $b->nama_tamu,
                        'akomodasi' => $akomodasiLabel,
                        'checkin' => $b->check_in_date->format('Y-m-d'),
                        'checkout' => $b->check_out_date->format('Y-m-d'),
                        'status' => $b->status,
                        'total' => $b->total,
                        'accommodation_id' => $b->accommodation_id,
                        'corporate_package_id' => $b->corporate_package_id,
                        'is_corporate' => $isCorporate,
                    ];
                    break;
                }
            }
        }

        return response()->json(['conflicts' => array_values($conflicts)]);
    }
}
