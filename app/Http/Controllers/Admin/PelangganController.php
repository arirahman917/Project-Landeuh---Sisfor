<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Tampilkan daftar pelanggan.
     */
    public function index()
    {
        $users = User::where(function($query) {
            $query->where('role', '!=', 'admin')
                  ->orWhereNull('role');
        })->orderBy('name', 'asc')->get();

        $pelanggans = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'telp' => $user->phone ?? '-',
                'tanggal_daftar' => $user->created_at ? $user->created_at->format('d M Y') : '-',
                'raw_date' => $user->created_at ? $user->created_at->format('Y-m-d') : null,
            ];
        });

        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    /**
     * Perbarui data pelanggan.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'telp' => 'nullable|string|max:20',
        ]);

        $user->name = $validated['nama'];
        $user->email = $validated['email'];
        $user->phone = $validated['telp'];
        $user->save();

        \App\Models\ActivityLog::log("Mengubah data pelanggan: " . $user->name . " (" . $user->email . ")");

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diperbarui.',
            'user' => [
                'id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'telp' => $user->phone ?? '-',
            ]
        ]);
    }

    /**
     * Hapus data pelanggan.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $name = $user->name;
        $email = $user->email;
        $user->delete();

        \App\Models\ActivityLog::log("Menghapus data pelanggan: " . $name . " (" . $email . ")");

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil dihapus.'
        ]);
    }
}
