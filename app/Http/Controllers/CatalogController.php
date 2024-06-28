<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttributeFilterResource;
use App\Http\Resources\AttributeResource;
use App\Models\Category;
use App\Models\Good;
use App\Services\FilterService;
use App\Services\SortService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function list(Request $request, $slug, Category $category, FilterService $filterService, SortService $sortService){

//        $goods = $category->getGoodsCategory();
//
//        // get min max
//        $minPrice = (float)$goods->min('price');
//        $maxPrice = (float)$goods->max('price');
//
//        // Apply filters and sorts
//        $goods = $filterService->apply($goods);
//        $goods = $sortService->apply($goods);

        $query = Good::with('photos', 'valueAttributes')->forCategory($category)->active();

        $minPrice = $query->min('price');
        $maxPrice = $query->max('price');

        $query = $filterService->apply($query);
        $query = $sortService->apply($query);

        $goods = $query->paginate(12);
        $goods->appends($request->all());

        if ($request->ajax()){
            return json_encode([
                'status' => true,
                'content' => view('catalog.list', ['goods' => $goods])->render()

            ]);
        }


        //$goods = $goods->paginate(12);

        // get Attributes
        $category = $category->load('filters', 'filters.values', 'filters.type', 'filters.values.attribute');
        $attributes = AttributeFilterResource::collection($category->filters);

        // get parameters from URL
//        $selectData = $request->all();
//        $selected = [];
//        foreach ($selectData as $key=>$val){
//            if ($key === 'sort'){
//                $selected[$key] = $val;
//            }else{
//                $data = explode(',', $val);
//                $int_data = [];
//                foreach ($data as $item){
//                    $int_data[] = (int)$item;
//                }
//                $selected[$key] = $int_data;
//            }
//        }

        return view('catalog.index', [
            'category' => $category,
            'goods' => $goods,
            'attributes' => $attributes,
            'selected' => getParametersRequest(),
            'min_price' => $minPrice,
            'max_price' => $maxPrice
        ]);
    }
}
