<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\SortService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function list($slug, Category $category,SortService $sortService){

        $goods = $category->getGoodsCategory();

        $goods = $sortService->apply($goods);

        $goods = $goods->paginate(12);

        return view('catalog.index', ['category' => $category, 'goods' => $goods]);
    }
}
