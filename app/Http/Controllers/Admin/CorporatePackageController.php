<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CorporatePackage;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class CorporatePackageController extends Controller
{
    public function index()
    {
        $packages = CorporatePackage::all();
        $accommodations = Accommodation::orderBy('jenis')->orderBy('judul')->get(['id', 'judul', 'jenis']);
        return view('admin.corporate.index', compact('packages', 'accommodations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'             => 'required|string|max:255',
            'jenis'             => 'required|string|max:100',
            'jenis_akomodasi'   => 'required|string|max:100',
            'accommodation_ids' => 'required|array|min:1',
            'accommodation_ids.*' => 'exists:accommodations,id',
            'fasilitas'         => 'nullable|array',
            'makanan'           => 'nullable|array',
            'catatan'           => 'nullable|array',
            'max_orang'         => 'required|integer|min:1',
            'harga_weekday'     => 'required|numeric|min:0',
            'harga_weekend'     => 'required|numeric|min:0',
            'harga_highseason'  => 'required|numeric|min:0',
        ]);

        $validated['slot'] = count($validated['accommodation_ids']);

        $gambarArray = [];
        if ($request->hasFile('gambar')) {
            $files = is_array($request->file('gambar')) ? $request->file('gambar') : [$request->file('gambar')];
            foreach ($files as $file) {
                try {
                    $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
                    $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                        'folder' => 'landeuh-corporate',
                        'format' => 'webp',
                        'quality' => 'auto',
                        'width' => 1200,
                        'crop' => 'limit'
                    ]);
                    $gambarArray[] = $result['secure_url'];
                } catch (\Throwable $e) {
                    \Log::error('Cloudinary upload failed: ' . $e->getMessage());
                    $path = $file->store('images/corporate', 'public');
                    $gambarArray[] = 'storage/' . $path;
                }
            }
        }

        $validated['gambar'] = $gambarArray;
        $validated['fasilitas'] = $validated['fasilitas'] ?? [];
        $validated['makanan']   = $validated['makanan'] ?? [];
        $validated['catatan']   = $validated['catatan'] ?? [];

        CorporatePackage::create($validated);

        return response()->json(['success' => true, 'message' => 'Paket corporate berhasil ditambahkan.']);
    }

    public function update(Request $request, $id)
    {
        $package = CorporatePackage::findOrFail($id);

        $validated = $request->validate([
            'judul'             => 'required|string|max:255',
            'jenis'             => 'required|string|max:100',
            'jenis_akomodasi'   => 'required|string|max:100',
            'accommodation_ids' => 'required|array|min:1',
            'accommodation_ids.*' => 'exists:accommodations,id',
            'fasilitas'         => 'nullable|array',
            'makanan'           => 'nullable|array',
            'catatan'           => 'nullable|array',
            'max_orang'         => 'required|integer|min:1',
            'harga_weekday'     => 'required|numeric|min:0',
            'harga_weekend'     => 'required|numeric|min:0',
            'harga_highseason'  => 'required|numeric|min:0',
        ]);

        $validated['slot'] = count($validated['accommodation_ids']);

        $gambarArray = [];
        if ($request->has('existing_gambar')) {
            $existing = is_array($request->existing_gambar) ? $request->existing_gambar : [$request->existing_gambar];
            $gambarArray = array_map(function($url) {
                return ltrim($url, '/');
            }, $existing);
        }

        if ($request->hasFile('gambar')) {
            $files = is_array($request->file('gambar')) ? $request->file('gambar') : [$request->file('gambar')];
            foreach ($files as $file) {
                try {
                    $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
                    $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                        'folder' => 'landeuh-corporate',
                        'format' => 'webp',
                        'quality' => 'auto',
                        'width' => 1200,
                        'crop' => 'limit'
                    ]);
                    $gambarArray[] = $result['secure_url'];
                } catch (\Throwable $e) {
                    \Log::error('Cloudinary upload failed: ' . $e->getMessage());
                    $path = $file->store('images/corporate', 'public');
                    $gambarArray[] = 'storage/' . $path;
                }
            }
        }

        $validated['gambar'] = $gambarArray;
        $validated['fasilitas'] = $validated['fasilitas'] ?? [];
        $validated['makanan']   = $validated['makanan'] ?? [];
        $validated['catatan']   = $validated['catatan'] ?? [];

        $package->update($validated);

        return response()->json(['success' => true, 'message' => 'Paket corporate berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $package = CorporatePackage::findOrFail($id);
        $package->delete();
        return response()->json(['success' => true, 'message' => 'Paket corporate berhasil dihapus.']);
    }
}
