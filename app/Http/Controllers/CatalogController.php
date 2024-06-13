<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttributeFilterResource;
use App\Http\Resources\AttributeResource;
use App\Models\Category;
use App\Services\SortService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function list($slug, Category $category,SortService $sortService){

        $goods = $category->getGoodsCategory();
        $goods = $sortService->apply($goods);
        $goods = $goods->paginate(12);

        $category = $category->load('filters', 'filters.values', 'filters.values.attribute');

        //dd($category);

        $attributes = AttributeFilterResource::collection($category->filters);



        return view('catalog.index', ['category' => $category, 'goods' => $goods, 'attributes' => $attributes]);
    }
}
