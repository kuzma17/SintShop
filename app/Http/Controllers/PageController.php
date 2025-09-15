<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function page(Page $page){
        return view('pages.page', ['page' => $page]);
    }

    public function admin(){
        return view('admin.layouts.app');
    }




}
