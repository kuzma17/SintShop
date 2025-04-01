<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

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




}
