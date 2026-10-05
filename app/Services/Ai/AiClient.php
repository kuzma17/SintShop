<?php

namespace App\Services\Ai;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class AiClient
{
    protected $client;
    public $url = 'https://api.openai.com/v1/chat/completions';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function queryChat($content)
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json; charset=UTF8',
                'Authorization' => 'Bearer ' . config('services.openai.key')
            ],
            'body' => Collection::make([
                // 'model' => "gpt-3.5-turbo",
                'model' => "gpt-4o-mini",
                'messages' => [
                    Collection::make([
                        'role' => "system",
                        'content' => "You are a helpful assistant."
                    ]),
                    Collection::make([
                        'role' => "user",
                        'content' => $content
                    ]),
                ]

            ])
        ];

        try {
            $response = $this->client->request('POST', $this->url, $options);
        } catch (\Throwable $e) {
            Log::channel('chatgpt')->error($e->getMessage(), $options);
            return false;
        }

        return json_decode($response->getBody())->choices[0]->message->content;

    }

}