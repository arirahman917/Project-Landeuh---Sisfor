<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperadminController extends Controller
{
    /**
     * Show Superadmin login view.
     */
    public function showLogin()
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        }
        return view('superadmin.auth.login');
    }

    /**
     * Perform Superadmin login attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            if ($user->role === 'superadmin') {
                $user->update(['last_login_at' => now()]);
                ActivityLog::log("Login ke Dashboard Superadmin", $user->id);
                
                return response()->json([
                    'success' => true,
                    'redirect' => route('superadmin.dashboard')
                ]);
            }

            // Not a superadmin - log out
            Auth::guard('admin')->logout();
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak: Anda bukan Superadmin.'
            ], 403);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);
    }

    /**
     * Show Superadmin dashboard.
     */
    public function dashboard()
    {
        $admins = User::where('role', 'admin')
            ->with(['activityLogs' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('superadmin.dashboard', compact('admins'));
    }

    /**
     * Approve admin registration.
     */
    public function approve($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->update(['status' => 'approved']);
        
        ActivityLog::log("Menyetujui pendaftaran admin {$admin->name} ({$admin->email})");

        return redirect()->back()->with('success', "Akun admin {$admin->name} telah disetujui.");
    }

    /**
     * Reject admin registration.
     */
    public function reject($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->update(['status' => 'rejected']);
        
        ActivityLog::log("Menolak pendaftaran admin {$admin->name} ({$admin->email})");

        return redirect()->back()->with('success', "Pendaftaran admin {$admin->name} telah ditolak.");
    }

    /**
     * Delete admin account.
     */
    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $name = $admin->name;
        $email = $admin->email;
        $admin->delete();

        ActivityLog::log("Menghapus akun admin {$name} ({$email})");

        return redirect()->back()->with('success', "Akun admin {$name} telah berhasil dihapus.");
    }

    /**
     * Logout Superadmin.
     */
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            ActivityLog::log("Logout dari Dashboard Superadmin", $user->id);
        }
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login')->with('info', 'Anda telah logout dari Superadmin.');
    }
}
