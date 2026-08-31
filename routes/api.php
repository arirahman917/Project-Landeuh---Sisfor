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

// WhatsApp Cloud API Webhook (Meta)
Route::get('/webhook/whatsapp', [WhatsAppWebhookController::class, 'verify']);
Route::post('/webhook/whatsapp', [WhatsAppWebhookController::class, 'handle']);
