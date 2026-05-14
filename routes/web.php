<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/akomodasi', function () {
    return view('akomodasi.akomodasi_detail');
})->name('akomodasi.index');

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
// ADMIN — Frontend-only auth (sessionStorage)
// ══════════════════════════════════════════════════════════════
Route::prefix('admin')->group(function () {

    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('admin.login');

    Route::get('/dashboard', function () {
        return view('admin.unit.index');
    })->name('admin.dashboard');

    Route::get('/unit', function () {
        return view('admin.unit.index');
    })->name('admin.unit.index');

    Route::get('/pesanan', function () {
        return view('admin.pesanan.index');
    })->name('admin.pesanan.index');

    Route::get('/pengembalian', function () {
        return view('admin.pesanan.pengembalian');
    })->name('admin.pengembalian.index');

    Route::get('/pelanggan', function () {
        return view('admin.pelanggan.index');
    })->name('admin.pelanggan.index');

    Route::get('/tanggal', function () {
        return view('admin.tanggal.index');
    })->name('admin.tanggal.index');
});

