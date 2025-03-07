<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\TelegramService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
   // protected $modelPage;
//    public function __construct(Page $page){
//        $this->modelPage = $page;
//    }
    public function page($slug, TelegramService $telegramService){

        dd($telegramService->sendMessage('Перезвоните мне Лариса +79868765432542'));
        //dd($this->messageChat());

        $page = Page::getPage($slug)?? abort(404);
        return view('pages.page', ['page' => $page]);
    }

    public function admin(){
        return view('admin.layouts.app');
    }




}
