<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function list($slug, Category $category){
        $goods = $category->getGoodsCategory()->paginate(12);

        return view('catalog.index', ['category' => $category, 'goods' => $goods]);
    }
}
