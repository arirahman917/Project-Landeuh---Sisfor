<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\CorporatePackage;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class UnitController extends Controller
{
    public function index()
    {
        // Fetch all accommodations with their active bookings
        $accommodations = Accommodation::with(['bookings' => function($query) {
            $query->whereNotIn('status', ['failed', 'refunded']);
        }])->get();

        // Fetch corporate packages with their active bookings
        $corporatePackages = CorporatePackage::with(['bookings' => function($query) {
            $query->whereNotIn('status', ['failed', 'refunded']);
        }])->get();

        $accommodations->transform(function ($item) use ($corporatePackages) {
            // Find corporate packages that include this accommodation
            $relatedCorporatePackages = $corporatePackages->filter(function($cp) use ($item) {
                return in_array($item->id, $cp->accommodation_ids ?? []);
            });

            // Inject corporate bookings into the item's bookings collection
            foreach ($relatedCorporatePackages as $cp) {
                foreach ($cp->bookings as $cb) {
                    $cb->is_corporate = true;
                    $cb->corporate_label = $cp->judul;
                    $item->bookings->push($cb);
                }
            }

            // Map keys for JS compatibility
            $item->hargaWeekday = $item->harga_weekday;
            $item->hargaWeekend = $item->harga_weekend;
            $item->hargaHighseason = $item->harga_highseason;
            $item->maxOrang = $item->max_orang;
            return $item;
        });

        return view('admin.unit.index', compact('accommodations'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['gambar']);
        
        $data['fasilitas'] = $request->fasilitas ? array_map('trim', explode(';', $request->fasilitas)) : [];
        $data['makanan'] = $request->makanan ? array_map('trim', explode(';', $request->makanan)) : [];
        $data['catatan'] = $request->catatan ? array_map('trim', explode(';', $request->catatan)) : [];
        $data['merokok'] = $request->merokok == '1';
        
        // Pastikan input angka tidak bernilai null
        $data['max_orang'] = (int) ($request->max_orang ?: 4);
        $data['slot'] = (int) ($request->slot ?: 1);
        $data['harga_weekday'] = (float) ($request->harga_weekday ?: 0);
        $data['harga_weekend'] = (float) ($request->harga_weekend ?: 0);
        $data['harga_highseason'] = (float) ($request->harga_highseason ?: 0);

        $gambarArray = [];
        if ($request->hasFile('gambar')) {
            $files = is_array($request->file('gambar')) ? $request->file('gambar') : [$request->file('gambar')];
            foreach ($files as $file) {
                try {
                    $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
                    $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                        'folder' => 'landeuh-akomodasi',
                        'format' => 'webp',
                        'quality' => 'auto',
                        'width' => 1200,
                        'crop' => 'limit'
                    ]);
                    $gambarArray[] = $result['secure_url'];
                } catch (\Throwable $e) {
                    \Log::error('Cloudinary upload failed: ' . $e->getMessage());
                    // Fallback to local storage if Cloudinary fails or is not configured
                    $path = $file->store('images/akomodasi', 'public');
                    $gambarArray[] = 'storage/' . $path;
                }
            }
        }
        
        if (empty($gambarArray)) {
            $gambarArray[] = 'images/akomodasi/cabin1/a.webp'; // default fallback
        }
        $data['gambar'] = $gambarArray;

        Accommodation::create($data);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $unit = Accommodation::findOrFail($id);
        $data = $request->except(['gambar', '_method']);
        
        if ($request->has('fasilitas')) {
            $data['fasilitas'] = $request->fasilitas ? array_map('trim', explode(';', $request->fasilitas)) : [];
        }
        if ($request->has('makanan')) {
            $data['makanan'] = $request->makanan ? array_map('trim', explode(';', $request->makanan)) : [];
        }
        if ($request->has('catatan')) {
            $data['catatan'] = $request->catatan ? array_map('trim', explode(';', $request->catatan)) : [];
        }
        if ($request->has('merokok')) {
            $data['merokok'] = $request->merokok == '1';
        }
        
        // Pastikan input angka tidak bernilai null
        if ($request->has('max_orang')) $data['max_orang'] = (int) ($request->max_orang ?: 4);
        if ($request->has('slot')) $data['slot'] = (int) ($request->slot ?: 1);
        if ($request->has('harga_weekday')) $data['harga_weekday'] = (float) ($request->harga_weekday ?: 0);
        if ($request->has('harga_weekend')) $data['harga_weekend'] = (float) ($request->harga_weekend ?: 0);
        if ($request->has('harga_highseason')) $data['harga_highseason'] = (float) ($request->harga_highseason ?: 0);

        $gambarArray = [];
        if ($request->has('existing_gambar')) {
            $existing = is_array($request->existing_gambar) ? $request->existing_gambar : [$request->existing_gambar];
            $gambarArray = array_map(function($url) {
                return ltrim($url, '/'); // remove leading slash if frontend added it
            }, $existing);
        }

        if ($request->hasFile('gambar')) {
            $files = is_array($request->file('gambar')) ? $request->file('gambar') : [$request->file('gambar')];
            foreach ($files as $file) {
                try {
                    $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
                    $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                        'folder' => 'landeuh-akomodasi',
                        'format' => 'webp',
                        'quality' => 'auto',
                        'width' => 1200,
                        'crop' => 'limit'
                    ]);
                    $gambarArray[] = $result['secure_url'];
                } catch (\Throwable $e) {
                    \Log::error('Cloudinary upload failed: ' . $e->getMessage());
                    // Fallback to local storage if Cloudinary fails or is not configured
                    $path = $file->store('images/akomodasi', 'public');
                    $gambarArray[] = 'storage/' . $path;
                }
            }
        }
        $data['gambar'] = $gambarArray;

        $unit->update($data);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Accommodation::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
