<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Langsung tandai email sebagai terverifikasi agar tidak perlu verifikasi lagi
        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);

        return response()->json(['message' => 'Registration successful', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login successful', 'user' => Auth::user()], 200);
        }

        return response()->json(['message' => 'The provided credentials do not match our records.'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Pastikan user memiliki role admin
            if ($user->role === 'admin') {
                return response()->json(['message' => 'Admin login successful'], 200);
            }

            // Bukan admin — logout dan tolak
            Auth::guard('admin')->logout();
            return response()->json(['message' => 'Akses ditolak: bukan admin.'], 403);
        }

        return response()->json(['message' => 'Email atau password salah.'], 401);
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'Admin logout successful'], 200);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Use stateless() to avoid session state mismatch behind reverse proxies
            $googleUser = Socialite::driver('google')->stateless()->user();

            \Log::info('Google OAuth callback - email: ' . $googleUser->getEmail());

            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
                if (!$user->email_verified_at) {
                    $user->update(['email_verified_at' => now()]);
                }
                Auth::login($user);
                \Log::info('Google OAuth - existing user logged in: ' . $user->id);
            } else {
                $newUser = User::create([
                    'name'              => $googleUser->getName(),
                    'email'             => $googleUser->getEmail(),
                    'google_id'         => $googleUser->getId(),
                    'password'          => null,
                    'email_verified_at' => now(),
                ]);

                Auth::login($newUser);
                \Log::info('Google OAuth - new user created: ' . $newUser->id);
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            \Log::error('Google OAuth error: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            return redirect('/')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        try {
            Mail::to($request->email)->send(new ResetPasswordMail($resetLink));
        } catch (\Exception $e) {
            \Log::error('Failed to send reset password email: ' . $e->getMessage());
        }

        return response()->json(['message' => 'Link reset password telah dikirim ke email Anda.']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return response()->json(['message' => 'Token reset password tidak valid atau sudah kedaluwarsa.'], 400);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password berhasil diubah! Silakan login.']);
    }
}
