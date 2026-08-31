<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\WhatsAppService;

class WhatsAppWebhookController extends Controller
{
    /**
     * Handle Webhook Verification from Meta
     * This is called by Meta when you set up the Webhook URL in the Dashboard.
     */
    public function verify(Request $request)
    {
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
     * Handle incoming Webhook events from Meta (messages, status updates, etc)
     */
    public function handle(Request $request)
    {
        $payload = $request->all();

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
