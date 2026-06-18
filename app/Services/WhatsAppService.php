<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send a WhatsApp message using Fonnte API.
     *
     * @param string $target Phone number to send to
     * @param string $message The message body
     * @param string|null $fileData Raw file content (e.g. PDF binary) to attach
     * @param string $fileName Name of the attached file
     * @return bool
     */
    public static function sendMessage(string $target, string $message, ?string $fileData = null, string $fileName = 'invoice.pdf'): bool
    {
        $token = env('FONNTE_TOKEN');
        
        if (empty($token) || $token === 'isi_dengan_token_fonnte_anda') {
            Log::warning("Fonnte token is not set. Cannot send WhatsApp message to {$target}");
            return false;
        }

        // Format number if needed (e.g., replace leading 0 with 62)
        if (str_starts_with($target, '0')) {
            $target = '62' . substr($target, 1);
        }

        $data = [
            'target' => $target,
            'message' => $message,
            'countryCode' => '62',
        ];

        // Attach file URL if provided
        if ($fileData) {
            $data['url'] = $fileData;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token
            ])->post('https://api.fonnte.com/send', $data);

            if ($response->successful()) {
                $responseData = $response->json();
                if (isset($responseData['status']) && $responseData['status'] === true) {
                    return true;
                }
            }

            Log::error("Fonnte API error: " . $response->body());
            return false;

        } catch (\Exception $e) {
            Log::error("Fonnte HTTP request failed: " . $e->getMessage());
            return false;
        }
    }
}
