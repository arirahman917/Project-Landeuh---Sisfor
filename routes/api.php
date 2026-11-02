<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rute di file ini otomatis mendapatkan prefix "/api" dan 
| TIDAK memiliki middleware CSRF, sehingga aman untuk Webhook.
|
*/

// ========================================================
// Webhook Fonnte API (Pesan Masuk + Anti-Spam Rate Limit 1 Jam)
// URL: https://landeuhvillage.com/api/webhook/fonnte
// ========================================================
Route::post('/webhook/fonnte', [WhatsAppWebhookController::class, 'handleFonnte']);


