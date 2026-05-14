<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Akun admin dummy (hardcoded).
     * Ganti dengan database lookup saat produksi.
     */
    private const ADMIN_EMAIL = 'admin@gmail.com';
    private const ADMIN_PASS  = 'admin123';
    private const ADMIN_NAME  = 'Administrator';

    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        // Jika sudah login, langsung ke dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Proses login (JSON response untuk Alpine.js fetch).
     */
    public function doLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $email    = strtolower(trim($request->email));
        $password = $request->password;

        // Cek kredensial dummy
        if ($email === self::ADMIN_EMAIL && $password === self::ADMIN_PASS) {
            // Set session
            session([
                'admin_logged_in' => true,
                'admin_email'     => $email,
                'admin_name'      => self::ADMIN_NAME,
                'admin_login_at'  => now()->toDateTimeString(),
            ]);

            // Regenerate session ID untuk keamanan
            $request->session()->regenerate();

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.dashboard'),
                'message'  => 'Login berhasil!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password tidak valid.',
        ], 401);
    }

    /**
     * Logout admin — hapus session lalu redirect ke login.
     */
    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin_logged_in',
            'admin_email',
            'admin_name',
            'admin_login_at',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('info', 'Anda telah logout.');
    }
}
