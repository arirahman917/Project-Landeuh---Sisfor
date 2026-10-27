<?php

namespace App\Services;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Kirim pesan WhatsApp menggunakan provider aktif (Default: Fonnte).
     *
     * @param string $target Nomor tujuan (contoh: 0857..., 62857..., +62857...)
     * @param string $message Isi pesan yang akan dikirim
     * @return bool
     */
    public static function sendMessage(string $target, string $message): bool
    {
        $provider = env('WA_PROVIDER', 'fonnte');

        if ($provider === 'meta') {
            return self::sendViaMeta($target, $message);
        }

        return self::sendViaFonnte($target, $message);
    }

    /**
     * Kirim WhatsApp melalui Gateway Fonnte API.
     * Endpoint: POST https://api.fonnte.com/send
     *
     * @param string $target
     * @param string $message
     * @return bool
     */
    public static function sendViaFonnte(string $target, string $message): bool
    {
        $token = env('FONNTE_TOKEN');

        if (empty($token)) {
            Log::warning("[Fonnte] API Token belum diset di .env (FONNTE_TOKEN). Pesan tidak dapat dikirim ke {$target}");
            return false;
        }

        // Normalisasi format nomor tujuan
        $cleanTarget = preg_replace('/[^0-9]/', '', $target);
        if (str_starts_with($cleanTarget, '0')) {
            $cleanTarget = '62' . substr($cleanTarget, 1);
        }

        try {
            $response = Http::asForm()
                ->withHeaders([
                    'Authorization' => $token,
                ])
                ->timeout(15)
                ->post('https://api.fonnte.com/send', [
                    'target' => $cleanTarget,
                    'message' => $message,
                    'countryCode' => '62',
                ]);

            Log::info("[Fonnte] Response status={$response->status()} target={$cleanTarget} body={$response->body()}");

            if ($response->successful()) {
                $body = $response->json();
                if (isset($body['status']) && $body['status'] === false) {
                    Log::error("[Fonnte] Error response: " . ($body['reason'] ?? $response->body()));
                    return false;
                }
                return true;
            }

            Log::error("[Fonnte] HTTP Error: " . $response->body());
            return false;

        } catch (\Exception $e) {
            Log::error("[Fonnte] HTTP Request Exception ke {$cleanTarget}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim notifikasi WhatsApp: Konfirmasi Pemesanan Berhasil (Template: booking_confirmation)
     * Sesuai PRD Seksi 5.1
     *
     * @param Booking $booking
     * @return bool
     */
    public static function sendBookingConfirmation(Booking $booking): bool
    {
        $booking->loadMissing(['accommodation', 'corporatePackage']);

        $checkIn = Carbon::parse($booking->check_in_date)->locale('id')->isoFormat('dddd, D MMMM Y');
        $checkOut = Carbon::parse($booking->check_out_date)->locale('id')->isoFormat('dddd, D MMMM Y');
        $totalStr = number_format($booking->total, 0, ',', '.');
        $invoiceUrl = url('/invoice/' . $booking->no_pesanan . '/download');
        $akomodasiJudul = $booking->accommodation ? $booking->accommodation->judul : ($booking->corporatePackage ? $booking->corporatePackage->judul : 'Akomodasi');
        
        $adminNumber = env('WA_ADMIN_NUMBER', '085779012797');
        $adminWaLink = 'https://wa.me/' . (str_starts_with($adminNumber, '0') ? '62' . substr($adminNumber, 1) : $adminNumber);

        $message = "Halo, {$booking->pemesan_nama}!\n\n"
                 . "Terima kasih telah melakukan pemesanan di *Landeuh Village Riverside*.\n\n"
                 . "Pembayaran Anda untuk pesanan *{$booking->no_pesanan}* telah BERHASIL diverifikasi.\n\n"
                 . "*DETAIL PESANAN*\n"
                 . "🏠 Akomodasi: {$akomodasiJudul}\n"
                 . "📅 Check-in: {$checkIn}\n"
                 . "🌙 Durasi: {$booking->malam} malam\n"
                 . "📅 Check-out: {$checkOut}\n"
                 . "💰 Total: IDR {$totalStr}\n"
                 . "💳 Metode pembayaran: {$booking->metode_pembayaran}\n\n"
                 . "*KEBIJAKAN PEMESANAN*\n"
                 . "- Pemesanan ini tidak dapat diubah.\n"
                 . "- Pemesanan tidak dapat di-refund apabila Anda membatalkannya.\n\n"
                 . "Silakan unduh E-Ticket/Invoice melalui tautan berikut:\n"
                 . "👉 {$invoiceUrl}\n\n"
                 . "Tunjukkan invoice tersebut atau sebutkan nomor pesanan saat proses check-in.\n\n"
                 . "Pesan ini dibuat otomatis oleh sistem (noreply).\n"
                 . "⚠️ Harap jangan membalas pesan ini karena balasan tidak akan dijawab.\n\n"
                 . "Jika ada pertanyaan, silakan hubungi Admin Customer Service:\n"
                 . "👉 {$adminWaLink}\n\n"
                 . "Salam hangat,\n"
                 . "Tim Landeuh Village Riverside";

        Log::info("Mengirim konfirmasi WhatsApp pemesanan #{$booking->no_pesanan} ke {$booking->pemesan_telp}");
        return self::sendMessage($booking->pemesan_telp, $message);
    }

    /**
     * Kirim notifikasi WhatsApp: Reschedule Disetujui (Template: booking_reschedule_approved)
     * Sesuai PRD Seksi 5.2
     *
     * @param Booking $booking
     * @return bool
     */
    public static function sendRescheduleApproved(Booking $booking): bool
    {
        $booking->loadMissing(['accommodation', 'corporatePackage']);

        $checkInBaru = Carbon::parse($booking->check_in_date)->locale('id')->isoFormat('dddd, D MMMM Y');
        $checkOutBaru = Carbon::parse($booking->check_out_date)->locale('id')->isoFormat('dddd, D MMMM Y');
        $invoiceUrl = url('/invoice/' . $booking->no_pesanan . '/download');
        $akomodasiJudul = $booking->accommodation ? $booking->accommodation->judul : ($booking->corporatePackage ? $booking->corporatePackage->judul : 'Akomodasi');
        
        $adminNumber = env('WA_ADMIN_NUMBER', '085779012797');
        $adminWaLink = 'https://wa.me/' . (str_starts_with($adminNumber, '0') ? '62' . substr($adminNumber, 1) : $adminNumber);

        $message = "Halo, {$booking->pemesan_nama}!\n\n"
                 . "Pengajuan reschedule untuk pesanan *{$booking->no_pesanan}* di *Landeuh Village Riverside* telah DISETUJUI dan berhasil diperbarui.\n\n"
                 . "*JADWAL PEMESANAN TERBARU*\n"
                 . "🏠 Akomodasi: {$akomodasiJudul}\n"
                 . "📅 Check-in baru: {$checkInBaru}\n"
                 . "🌙 Durasi: {$booking->malam} malam\n"
                 . "📅 Check-out baru: {$checkOutBaru}\n\n"
                 . "Mohon gunakan jadwal terbaru di atas sebagai acuan saat kedatangan.\n\n"
                 . "Invoice/E-Ticket terbaru dapat diunduh melalui tautan berikut:\n"
                 . "👉 {$invoiceUrl}\n\n"
                 . "Pesan ini dibuat otomatis oleh sistem (noreply).\n"
                 . "⚠️ Harap jangan membalas pesan ini karena balasan tidak akan dijawab.\n\n"
                 . "Jika ada pertanyaan, silakan hubungi Admin Customer Service:\n"
                 . "👉 {$adminWaLink}\n\n"
                 . "Salam hangat,\n"
                 . "Tim Landeuh Village Riverside";

        Log::info("Mengirim notifikasi WhatsApp reschedule disetujui #{$booking->no_pesanan} ke {$booking->pemesan_telp}");
        return self::sendMessage($booking->pemesan_telp, $message);
    }

    // =========================================================================
    // [NONAKTIF - ARSIP KODE META CLOUD API]
    // Kode di bawah ini adalah implementasi Meta Cloud API lama yang dinonaktifkan
    // sesuai instruksi migrasi ke Fonnte. Tetap disimpan sebagai arsip referensi.
    // =========================================================================

    /**
     * Send a WhatsApp message using Meta Cloud API (Graph API) - [STATUS: NONAKTIF/ARCHIVED].
     *
     * @param string $target Phone number to send to (format: 0857... or 62857...)
     * @param string $message The message body
     * @return bool
     */
    public static function sendViaMeta(string $target, string $message): bool
    {
        $token = env('WA_ACCESS_TOKEN');
        $phoneId = env('WA_BUSINESS_PHONE_NUMBER_ID');
        
        if (empty($token) || empty($phoneId)) {
            Log::warning("[Meta Inactive] WhatsApp Meta Cloud API credentials are not set. Cannot send message to {$target}");
            return false;
        }

        // Format number: Meta requires international format without '+' or leading '0'
        if (str_starts_with($target, '0')) {
            $target = '62' . substr($target, 1);
        } else if (str_starts_with($target, '+')) {
            $target = substr($target, 1);
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'to' => $target,
            'type' => 'text',
            'text' => [
                'preview_url' => true,
                'body' => $message,
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ])->post("https://graph.facebook.com/v20.0/{$phoneId}/messages", $data);

            Log::info("WhatsApp Meta API response: status={$response->status()} body={$response->body()}");

            if ($response->successful()) {
                return true;
            }

            Log::error("WhatsApp Meta API error: " . $response->body());
            return false;

        } catch (\Exception $e) {
            Log::error("WhatsApp Meta HTTP request failed: " . $e->getMessage());
            return false;
        }
    }
}
