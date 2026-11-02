<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Services\WhatsAppService;

/**
 * Controller untuk menangani Webhook WhatsApp
 * - Fonnte Gateway: Menangani pesan masuk dengan Anti-Spam Rate Limiting (Maks 1x per jam per nomor).
 * - Meta Cloud API: [Arsip Nonaktif].
 */
class WhatsAppWebhookController extends Controller
{
    /**
     * Handle Webhook pesan masuk dari Fonnte API dengan Anti-Spam Rate Limit (1 jam sekali per nomor).
     * Sesuai PRD Seksi 5.3.
     */
    public function handleFonnte(Request $request)
    {
        $sender = $request->input('sender');
        $message = $request->input('message');
        $member = $request->input('member');

        Log::info("[Fonnte Webhook Received]", [
            'sender' => $sender,
            'message' => $message,
        ]);

        if (empty($sender)) {
            return response()->json(['status' => 'ignored_no_sender'], 200);
        }

        // Abaikan pesan dari grup WhatsApp agar tidak spam di grup
        if (str_contains($sender, '@g.us') || !empty($member)) {
            Log::info("[Fonnte Webhook] Pesan dari grup WhatsApp diabaikan ({$sender}).");
            return response()->json(['status' => 'ignored_group_message'], 200);
        }

        // Bersihkan nomor pengirim
        $cleanSender = preg_replace('/[^0-9]/', '', $sender);

        // Jangan balas jika pesan berasal dari nomor bot sendiri
        $botNumber = config('services.whatsapp.sender') ?: env('WA_SENDER_NUMBER', '6285692811221');
        $cleanBot = preg_replace('/[^0-9]/', '', $botNumber);
        if ($cleanSender === $cleanBot) {
            return response()->json(['status' => 'ignored_self_message'], 200);
        }

        // KUNCI RATE LIMITING: Cooldown 1 jam (60 menit) per nomor pengirim
        $cooldownMinutes = (int) (env('WA_AUTOREPLY_COOLDOWN_MINUTES', 60));
        $cacheKey = 'wa_autoreply_cooldown_' . $cleanSender;

        if (Cache::has($cacheKey)) {
            $lastSentAt = Cache::get($cacheKey);
            Log::info("[Fonnte Webhook] Pesan dari {$cleanSender} TIDAK dibalas karena masih dalam masa cooldown 1 jam. Terakhir dibalas: {$lastSentAt}. Kuota aman!");
            return response()->json([
                'status' => 'rate_limited',
                'message' => 'Autoreply ignored to prevent spam/token drain'
            ], 200);
        }

        // Simpan penanda di Cache selama 1 jam (60 menit)
        Cache::put($cacheKey, now()->toDateTimeString(), now()->addMinutes($cooldownMinutes));

        $adminNumber = config('services.whatsapp.admin') ?: env('WA_ADMIN_NUMBER', '085779012797');
        $adminWaLink = 'https://wa.me/' . (str_starts_with($adminNumber, '0') ? '62' . substr($adminNumber, 1) : $adminNumber);

        // Pesan Auto-Reply resmi sesuai PRD Seksi 5.3
        $replyText = "Halo, terima kasih telah menghubungi Landeuh Village Riverside.\n\n"
                   . "Nomor ini adalah sistem notifikasi otomatis (noreply) dan tidak melayani balasan chat.\n\n"
                   . "Jika Anda memiliki pertanyaan, konfirmasi, atau membutuhkan bantuan lebih lanjut, silakan langsung menghubungi Admin Customer Service kami di:\n"
                   . "👉 {$adminWaLink}\n\n"
                   . "Terima kasih.\n"
                   . "Tim Landeuh Village Riverside";

        Log::info("[Fonnte Webhook] Mengirim autoreply ke {$cleanSender}. Nomor ini tidak akan dibalas lagi selama {$cooldownMinutes} menit ke depan.");
        WhatsAppService::sendMessage($cleanSender, $replyText);

        return response()->json([
            'status' => 'success',
            'message' => 'Autoreply sent successfully'
        ], 200);
    }
    /**
     * Handle Webhook Verification from Meta [NONAKTIF]
     * This is called by Meta when you set up the Webhook URL in the Dashboard.
     */
    public function verify(Request $request)
    {
        // Guard: Meta Webhook dinonaktifkan demi Fonnte
        if (env('WA_PROVIDER', 'fonnte') !== 'meta') {
            Log::info("[Meta Webhook Inactive] Verifikasi webhook diakses tetapi provider saat ini adalah Fonnte.");
            return response('Webhook Meta dinonaktifkan (aktif: Fonnte)', 200);
        }

        $mode = $request->query('hub_mode') ?? $request->query('hub.mode') ?? $request->input('hub_mode') ?? $request->input('hub.mode');
        $token = $request->query('hub_verify_token') ?? $request->query('hub.verify_token') ?? $request->input('hub_verify_token') ?? $request->input('hub.verify_token');
        $challenge = $request->query('hub_challenge') ?? $request->query('hub.challenge') ?? $request->input('hub_challenge') ?? $request->input('hub.challenge');
        
        $verifyToken = env('WA_WEBHOOK_VERIFY_TOKEN');
        if (empty($verifyToken)) {
            $verifyToken = 'LandeuhVillageRiverside290826';
        }

        if ($mode && $token) {
            if ($mode === 'subscribe' && $token === $verifyToken) {
                Log::info("WhatsApp Webhook verified successfully.");
                return response($challenge, 200);
            } else {
                Log::warning("WhatsApp Webhook verification failed. Token mismatch: expected {$verifyToken}, got {$token}");
                return response('Forbidden', 403);
            }
        }

        return response('Bad Request', 400);
    }

    /**
     * Handle incoming Webhook events from Meta [NONAKTIF]
     */
    public function handle(Request $request)
    {
        // Guard: Meta Webhook dinonaktifkan demi Fonnte
        if (env('WA_PROVIDER', 'fonnte') !== 'meta') {
            Log::info("[Meta Webhook Inactive] Event webhook masuk tetapi provider saat ini adalah Fonnte.");
            return response()->json([
                'status' => 'inactive',
                'message' => 'Meta webhook is deactivated. System uses Fonnte with provider-side autoreply.'
            ], 200);
        }

        $payload = $request->all();
        Log::info("WhatsApp Webhook payload received: " . json_encode($payload));

        // Check if this is a WhatsApp Business Account event
        if (isset($payload['object']) && $payload['object'] === 'whatsapp_business_account') {
            
            foreach ($payload['entry'] as $entry) {
                foreach ($entry['changes'] as $change) {
                    $value = $change['value'];
                    
                    // If this is a message from a user (not a status update)
                    if (isset($value['messages']) && !empty($value['messages'])) {
                        $message = $value['messages'][0];
                        $from = $message['from']; // The user's phone number
                        $messageType = $message['type'];
                        
                        // We only auto-reply to incoming texts, images, etc.
                        if (in_array($messageType, ['text', 'image', 'document', 'audio', 'video'])) {
                            
                            $adminNumber = env('WA_ADMIN_NUMBER', '085779012797');
                            $adminNumberFormatted = str_starts_with($adminNumber, '0') ? '62' . substr($adminNumber, 1) : $adminNumber;
                            
                            $replyMessage = "Terima kasih telah menghubungi Landeuh Village Riverside.\n\n"
                                          . "Nomor ini adalah sistem otomatis (Bot) yang hanya digunakan untuk mengirimkan konfirmasi pembayaran (Invoice).\n\n"
                                          . "Untuk semua pertanyaan, bantuan, atau informasi lebih lanjut, silakan langsung menghubungi Admin Customer Service kami di:\n\n"
                                          . "👉 wa.me/{$adminNumberFormatted}\n\n"
                                          . "Terima kasih dan sehat selalu! 🙏";
                                          
                            Log::info("Auto-replying to WhatsApp message from: {$from}");
                            WhatsAppService::sendMessage($from, $replyMessage);
                        }
                    }
                }
            }
            
            // Meta expects a 200 OK response quickly to acknowledge receipt
            return response()->json(['status' => 'ok'], 200);
        }

        return response('Not Found', 404);
    }
}
