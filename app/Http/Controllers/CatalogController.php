<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use App\Services\FilterService;
use App\Services\SortService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function list(Request $request, $slug, Category $category, FilterService $filterService, SortService $sortService){

        $query = Good::forCategory($category)->active();

        $minPrice = $query->min('price');
        $maxPrice = $query->max('price');

        $query = $filterService->apply($query);
        $query = $sortService->apply($query);

        $count_values = $filterService->getCountAttributes();

        $url_params = request()->except('page');

        $goods = $query->paginate(12)->appends($url_params);
       // $goods->appends($request->all());

       // $goods = $goods->load('photos');

        $goods->getCollection()->load('valueAttributes','photos');

        if ($request->ajax()){
            return json_encode([
                'status' => true,
                'content' => view('catalog.list', ['goods' => $goods])->render()

            ]);
        }

        return view('catalog.index', [
            'category' => $category,
            'goods' => $goods,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'count_values' => $count_values,
        ]);
    }


}
