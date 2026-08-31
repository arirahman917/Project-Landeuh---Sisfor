<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send a WhatsApp message using Meta Cloud API (Graph API).
     *
     * @param string $target Phone number to send to (format: 0857... or 62857...)
     * @param string $message The message body
     * @return bool
     */
    public static function sendMessage(string $target, string $message): bool
    {
        $token = env('WA_ACCESS_TOKEN');
        $phoneId = env('WA_BUSINESS_PHONE_NUMBER_ID');
        
        if (empty($token) || empty($phoneId)) {
            Log::warning("WhatsApp Meta Cloud API credentials are not set. Cannot send message to {$target}");
            return false;
        }

        // Format number: Meta requires international format without '+' or leading '0'
        // e.g. 62857...
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
