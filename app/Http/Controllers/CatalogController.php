<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use App\Services\FilterService;
use App\Services\SortService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function list(Request $request, $slug, FilterService $filterService, SortService $sortService){

        $category = Category::getCategory($slug);

        $query = $category->goods()->active();

        $minPrice = $query->min('price');
        $maxPrice = $query->max('price');

        $query = $filterService->apply($query);
        $query = $sortService->apply($query);

        $filters = $filterService->getFilters($category);

        $url_params = request()->except('page');

        $goods = $query->paginate(12)->appends($url_params);
       // $goods->appends($request->all());

       // $goods = $goods->load('photos');

        $goods->getCollection()->load('valueAttributes','photos');

        if ($request->ajax()){

            return response()->json([
                'status' => true,
                'content' => view('catalog.list', ['goods' => $goods])->render(),
                'filters' => $filters

            ]);
        }

        return view('catalog.index', [
            'category' => $category,
            'goods' => $goods,
            'minPrice' => $minPrice? $minPrice: 0,
            'maxPrice' => $maxPrice? $maxPrice: 0,
            'filters' => $filters
        ]);
    }


}
