<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttributeFilterResource;
use App\Http\Resources\AttributeResource;
use App\Models\Category;
use App\Services\FilterService;
use App\Services\SortService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function list(Request $request, $slug, Category $category, FilterService $filterService, SortService $sortService){

        $goods = $category->getGoodsCategory();

        $minPrice = (float)$goods->min('price');
        $maxPrice = (float)$goods->max('price');

        $goods = $filterService->apply($goods);
        $goods = $sortService->apply($goods);

        $goods = $goods->paginate(12);

        $category = $category->load('filters', 'filters.values', 'filters.type', 'filters.values.attribute');
        $attributes = AttributeFilterResource::collection($category->filters);

        $selectData = $request->all();
        $selected = [];
        foreach ($selectData as $key=>$val){
            if ($key === 'sort'){
                $selected[$key] = $val;
            }else{
                $data = explode(',', $val);
                $int_data = [];
                foreach ($data as $item){
                    $int_data[] = (int)$item;
                }
                $selected[$key] = $int_data;
            }
        }

        //dd($minPrice);

        return view('catalog.index', [
            'category' => $category,
            'goods' => $goods,
            'attributes' => $attributes,
            'selected' => $selected,
            'min_price' => $minPrice,
            'max_price' => $maxPrice
        ]);
    }
}
