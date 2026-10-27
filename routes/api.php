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
// [NONAKTIF] WhatsApp Cloud API Webhook (Meta) - Diarsipkan
// Dinonaktifkan karena beralih ke provider Fonnte (autoreply dikelola di dashboard Fonnte)
// ========================================================
// Route::get('/webhook/whatsapp', [WhatsAppWebhookController::class, 'verify']);
// Route::post('/webhook/whatsapp', [WhatsAppWebhookController::class, 'handle']);

