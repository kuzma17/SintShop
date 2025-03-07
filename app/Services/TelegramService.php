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
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        return $response->successful();

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