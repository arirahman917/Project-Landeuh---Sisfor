<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/akomodasi', [LandingController::class, 'akomodasi'])->name('akomodasi.index');

Route::get('/pesanan', function () {
    return view('pesanan.index');
})->name('pesanan.index');

Route::get('/reservasi/overview/{id}', function ($id) {
    return view('reservasi.overview', ['id' => $id]);
})->name('reservasi.overview');

Route::get('/reservasi/metode-pembayaran/{id}', function ($id) {
    return view('reservasi.metode', ['id' => $id]);
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

Route::get('/reservasi/konfirmasi', function () {
    return view('reservasi.konfirmasi');
})->name('reservasi.konfirmasi');

// ══════════════════════════════════════════════════════════════
// USER AUTH
// ══════════════════════════════════════════════════════════════
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with('success', 'Email berhasil diverifikasi.');
})->middleware(['auth', 'signed'])->name('verification.verify');

// ══════════════════════════════════════════════════════════════
// ADMIN — Frontend-only auth (sessionStorage)
// ══════════════════════════════════════════════════════════════
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\PesananController;

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

    Route::get('/pengembalian', function () {
        return view('admin.pesanan.pengembalian');
    })->name('admin.pengembalian.index');

    Route::get('/pelanggan', function () {
        return view('admin.pelanggan.index');
    })->name('admin.pelanggan.index');

    Route::get('/tanggal', [App\Http\Controllers\Admin\TanggalController::class, 'index'])->name('admin.tanggal.index');
    Route::post('/tanggal', [App\Http\Controllers\Admin\TanggalController::class, 'updateAll'])->name('admin.tanggal.updateAll');
});

