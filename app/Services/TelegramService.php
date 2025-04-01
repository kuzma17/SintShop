<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected $token;
    protected $chatId;
    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');
    }
    public function sendMessage($message)
    {
        try {
            $url = "https://api.telegram.org/bot{$this->token}/sendMessage";

            $response = Http::post($url, [
                'chat_id' => $this->chatId,
                'text' => $message,
            ]);

            if (!$response->successful()) {
                \Log::error('Error send to Telegram', ['response' => $response->body()]);
            }

            return $response->successful();
        } catch (\Exception $e) {
            \Log::error('Error sending message to Telegram', ['error' => $e->getMessage()]);
            return false;
        }

    }

    public function getUpdates()
    {
        $url = "https://api.telegram.org/bot{$this->token}/getUpdates";

        $response = Http::get($url, []);

        if ($response->successful()) {
            return $response->json();
        }

        return $response->body();

    }

    public function deleteWebhook()
    {
        $url = "https://api.telegram.org/bot{$this->token}/deleteWebhook";

        $response = Http::get($url, []);

        if ($response->successful()) {
            return $response->json();
        }

        return $response->body();

    }

}