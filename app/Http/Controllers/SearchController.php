<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Services\SortService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, SortService $sortService){

        $q = $request->query('search');
        $q = cleanText($q);
        $goods = Good::search($q)->get();
        $goods = $sortService->apply($goods);
        $goods = $goods->paginate(12);

        return view('search.index', ['q' => $q, 'goods' => $goods]);

    }
}
