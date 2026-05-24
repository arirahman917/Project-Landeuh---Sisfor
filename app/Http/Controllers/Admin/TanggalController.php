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

        return view('admin.tanggal.index', compact('weekday', 'weekend', 'highseason'));
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
        // To make it simple, we can delete all existing highseason and re-insert them
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

        return response()->json(['message' => 'Tanggal berhasil diperbarui']);
    }
}
