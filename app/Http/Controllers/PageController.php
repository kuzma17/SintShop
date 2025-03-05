<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
   // protected $modelPage;
//    public function __construct(Page $page){
//        $this->modelPage = $page;
//    }
    public function page($slug){
        $page = Page::getPage($slug)?? abort(404);
        return view('pages.page', ['page' => $page]);
    }

    public function admin(){
        return view('admin.layouts.app');
    }

    public function store(Request $request)
    {
        $account_id = 106157;


        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $name  = $request->input('name');
        $phone = $request->input('phone');

        // Отправляем данные в Chatwoot через API
        $response = Http::post(env('CHATWOOT_API_URL') . '/api/v1/accounts/{account_id}/conversations', [
            'inbox_id'  => env('CHATWOOT_INBOX_ID'),
            'source_id' => $phone, // Используем телефон как идентификатор
            'contact'   => [
                'name'  => $name,
                'phone' => $phone,
            ],
            'message' => "Запрос на обратный звонок от {$name}, телефон: {$phone}",
        ]);

        return response()->json(['message' => 'Заявка отправлена'], 201);
    }
}
