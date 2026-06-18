<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ReservasiController;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/setup-admin-landeuh-rahasia', function () {
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@landeuh.com'],
        [
            'name' => 'Admin Landeuh',
            'phone' => '081234567890',
            'password' => \Illuminate\Support\Facades\Hash::make('admin12345'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]
    );
    return 'Berhasil! Akun Admin telah dibuat di Database. Silakan login ke /admin/login menggunakan Email: admin@landeuh.com dan Password: admin12345';
});

Route::get('/akomodasi', [LandingController::class, 'akomodasi'])->name('akomodasi.index');

Route::get('/debug-session-set', function () {
    session(['test_key' => 'Hello from session! ' . time()]);
    return 'Session set. Now go to /debug-session-get';
});

Route::get('/debug-session-get', function () {
    return 'Session value: ' . session('test_key', 'NOT SET') . ' | Driver: ' . config('session.driver');
});

Route::get('/debug-login', function () {
    $user = \App\Models\User::first();
    if (!$user) {
        return 'No users in database. Please register first.';
    }
    Auth::login($user);
    // Don't regenerate session here just to see if regenerate() is the culprit
    return 'Logged in as ' . $user->email . '. Now go to /debug-check';
});

Route::get('/debug-check', function () {
    if (Auth::check()) {
        return 'LOGGED IN: ' . Auth::user()->email;
    } else {
        return 'NOT LOGGED IN. Session data: ' . json_encode(session()->all());
    }
});

Route::get('/debug-email', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('This is a test email from Landeuh Sisfor.', function ($message) {
            $message->to(config('mail.from.address'))
                    ->subject('SMTP Test');
        });
        return 'SUCCESS: Email sent successfully! Check the inbox of ' . config('mail.from.address');
    } catch (\Exception $e) {
        return 'ERROR: ' . $e->getMessage() . '<br><br>Trace:<br>' . nl2br($e->getTraceAsString());
    }
});

Route::get('/pesanan', function () {
    $bookings = [];
    if (Auth::check()) {
        $bookings = \App\Models\Booking::where('pemesan_email', Auth::user()->email)
            ->with('accommodation')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    return view('pesanan.index', compact('bookings'));
})->name('pesanan.index');

Route::get('/reservasi/overview/{id}', function (Illuminate\Http\Request $request, $id) {
    $accommodation = \App\Models\Accommodation::findOrFail($id);
    
    $checkinParam = $request->query('checkin');
    $malam = intval($request->query('malam') ?? 1);
    
    try {
        $checkInDate = $checkinParam ? \Carbon\Carbon::parse($checkinParam) : \Carbon\Carbon::now();
    } catch (\Exception $e) {
        $checkInDate = \Carbon\Carbon::now();
    }
    
    $checkOutDate = $checkInDate->copy()->addDays($malam);
    
    // Calculate the maximum bookings on any single night in this range
    $maxBookedCount = 0;
    for ($d = $checkInDate->copy(); $d->lt($checkOutDate); $d->addDay()) {
        $currentDate = $d->format('Y-m-d');
        
        $count = \App\Models\Booking::where('accommodation_id', $id)
            ->whereNotIn('status', ['failed', 'refunded'])
            ->where(function($query) use ($currentDate) {
                $query->where('check_in_date', '<=', $currentDate)
                      ->where('check_out_date', '>', $currentDate);
            })
            ->count();
            
        if ($count > $maxBookedCount) {
            $maxBookedCount = $count;
        }
    }
    
    $remainingSlots = max(0, $accommodation->slot - $maxBookedCount);
    
    // Fetch all DateSettings from database
    $dateSettings = \App\Models\DateSetting::all();

    return view('reservasi.overview', [
        'id' => $id,
        'accommodation' => $accommodation,
        'dateSettings' => $dateSettings,
        'remainingSlots' => $remainingSlots,
        'totalSlots' => $accommodation->slot
    ]);
})->name('reservasi.overview');

Route::post('/reservasi/store', [ReservasiController::class, 'store'])->name('reservasi.store');
Route::post('/reservasi/get-snap-token', [ReservasiController::class, 'getSnapToken'])->name('reservasi.snap-token');
Route::post('/reservasi/update-status', [ReservasiController::class, 'updateStatus'])->name('reservasi.update-status');

Route::get('/reservasi/metode-pembayaran/{id}', function (Illuminate\Http\Request $request, $id) {
    $booking = null;
    $bookingNo = $request->query('booking_no') ?? $request->query('order_id');
    if ($bookingNo) {
        $booking = \App\Models\Booking::where('no_pesanan', $bookingNo)->with('accommodation')->first();
    }
    return view('reservasi.metode', ['id' => $id, 'booking' => $booking]);
})->name('reservasi.metode');

Route::get('/payment/virtual-account', function () {
    return view('payment.virtual-account');
})->name('payment.virtual-account');

Route::get('/payment/atm', function () {
    return view('payment.atm');
})->name('payment.atm');

Route::get('/payment/minimarket', function () {
    return view('payment.minimarket');
})->name('payment.minimarket');

Route::get('/payment/qris', function () {
    return view('payment.qris');
})->name('payment.qris');

Route::get('/reservasi/konfirmasi', function (Illuminate\Http\Request $request) {
    $booking = null;
    $bookingNo = $request->query('booking_no') ?? $request->query('order_id');
    if ($bookingNo) {
        $booking = \App\Models\Booking::where('no_pesanan', $bookingNo)->with('accommodation')->first();
    }
    return view('reservasi.konfirmasi', compact('booking'));
})->name('reservasi.konfirmasi');

// ══════════════════════════════════════════════════════════════
// USER AUTH
// ══════════════════════════════════════════════════════════════
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/reset-password/{token}', function ($token, Illuminate\Http\Request $request) {
    return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
})->name('password.reset');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with('success', 'Email berhasil diverifikasi.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return response()->json(['message' => 'Email sudah diverifikasi.'], 200);
    }
    app()->terminating(function () use ($request) {
        try {
            $request->user()->sendEmailVerificationNotification();
        } catch (\Exception $e) {
            \Log::error('Failed to resend verification email: ' . $e->getMessage());
        }
    });
    return response()->json(['message' => 'Proses pengiriman email di latar belakang telah dimulai!'], 200);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ══════════════════════════════════════════════════════════════
// ADMIN — Frontend-only auth (sessionStorage)
// ══════════════════════════════════════════════════════════════
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\PelangganController;

Route::prefix('admin')->group(function () {

    Route::get('/login', function () {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    })->name('admin.login');

    Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout.post');

    Route::get('/dashboard', [UnitController::class, 'index'])->name('admin.dashboard');

    Route::get('/unit', [UnitController::class, 'index'])->name('admin.unit.index');
    Route::post('/unit', [UnitController::class, 'store'])->name('admin.unit.store');
    Route::put('/unit/{id}', [UnitController::class, 'update'])->name('admin.unit.update');
    Route::delete('/unit/{id}', [UnitController::class, 'destroy'])->name('admin.unit.destroy');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan.index');

    Route::get('/pembatalan', function () {
        // Fetch bookings that are related to refunds (pending, refunded, or rejected)
        $bookings = \App\Models\Booking::with('accommodation')
            ->whereIn('status', ['refund_pending', 'refunded', 'refund_rejected'])
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $formattedBookings = $bookings->map(function ($booking) {
            $statusMap = [
                'refund_pending' => 'pending',
                'refunded' => 'accepted',
                'refund_rejected' => 'rejected'
            ];
            return [
                'id' => $booking->id,
                'noPesanan' => $booking->no_pesanan,
                'pemesanNama' => $booking->pemesan_nama,
                'pemesanTelp' => $booking->pemesan_telp,
                'pemesanEmail' => $booking->pemesan_email,
                'namaTamu' => $booking->nama_tamu,
                'akomodasi' => $booking->accommodation->judul,
                'akomodasiCap' => '(' . $booking->accommodation->max_orang . ' pax)',
                'malam' => $booking->malam,
                'tanggalDipesan' => $booking->created_at->locale('id')->isoFormat('D MMM YYYY'),
                'checkin' => $booking->check_in_date->locale('id')->isoFormat('ddd, D MMM YYYY'),
                'checkout' => $booking->check_out_date->locale('id')->isoFormat('ddd, D MMM YYYY'),
                'total' => $booking->total,
                'metode' => $booking->metode_pembayaran,
                'status' => $statusMap[$booking->status] ?? 'pending',
                'tanggalAjuan' => $booking->updated_at->locale('id')->isoFormat('D MMM YYYY'),
            ];
        });
        
        return view('admin.pesanan.pembatalan', compact('formattedBookings'));
    })->name('admin.pembatalan.index');

    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan.index');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.destroy');

    Route::get('/tanggal', [App\Http\Controllers\Admin\TanggalController::class, 'index'])->name('admin.tanggal.index');
    Route::post('/tanggal', [App\Http\Controllers\Admin\TanggalController::class, 'updateAll'])->name('admin.tanggal.updateAll');

    // API endpoint for notifications (AJAX Polling)
    Route::get('/api/notifications', function () {
        if (!Auth::guard('admin')->check()) {
            return response()->json([], 401);
        }

        $recentBookings = \App\Models\Booking::with('accommodation')
            ->where(function($query) {
                $query->where(function($q) {
                    $q->where('status', 'success')
                      ->where('created_at', '>=', now()->subDays(5));
                })->orWhere(function($q) {
                    $q->where('status', 'refund_pending')
                      ->where('updated_at', '>=', now()->subDays(5));
                });
            })
            ->get();

        $notifications = $recentBookings->map(function ($booking) {
            $type = $booking->status === 'refund_pending' ? 'cancel' : 'order';
            $title = $booking->status === 'refund_pending' ? 'Pengajuan Pembatalan' : 'Pesanan Baru Masuk';
            
            $accTitle = $booking->accommodation ? $booking->accommodation->judul : 'Akomodasi';
            $desc = $booking->status === 'refund_pending'
                ? "{$booking->pemesan_nama} mengajukan pembatalan pesanan #{$booking->no_pesanan}."
                : "{$booking->pemesan_nama} memesan {$accTitle} untuk {$booking->malam} malam.";
                
            $timeStr = $booking->status === 'refund_pending'
                ? $booking->updated_at->diffForHumans()
                : $booking->created_at->diffForHumans();

            return [
                'type' => $type,
                'title' => $title,
                'desc' => $desc,
                'time' => $timeStr,
                'read' => false,
                'noPesanan' => $booking->no_pesanan,
                'active_time' => $booking->status === 'refund_pending' 
                    ? $booking->updated_at->toIso8601String() 
                    : $booking->created_at->toIso8601String(),
            ];
        });

        $sortedNotifications = $notifications->sortByDesc('active_time')->values()->take(10)->toArray();

        return response()->json($sortedNotifications);
    })->name('admin.api.notifications');
});

