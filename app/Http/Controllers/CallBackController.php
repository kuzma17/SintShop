<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallBackRequest;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class CallBackController extends Controller
{
    public function __invoke(Request $request, TelegramService $telegramService)
    {
        $massege = 'Sint-shop.com. Call back on the number '.$request->phone.' '.$request->name;
        $telegramService->sendMessage($massege);

        return $request->json(['success' => true]);
    }
}
