<?php

namespace App\Services;

use Illuminate\Http\Request;

class SortService
{

    public $sort = 'newGood';

    public function __construct(Request $request){

        $response = $this->getSort($request);
        if ($response){
            $this->sort = $response;
        }
    }
    protected function getSort(Request $request){

        return $request->query->get('sort');
    }

    protected function new($goods, $path=null){
//        return $goods->sortByDesc('created_at');
        return $goods->orderBy('created_at', 'desc');
    }

    protected function priceAsc($goods){
        //return $goods->sortBy('price');
        return $goods->orderBy('price', 'asc');
    }

    protected function priceDesc($goods){
        //return $goods->sortByDesc('price');
        return $goods->orderBy('price', 'desc');
    }

    public function apply($goods){
        $method = $this->sort;

        if(method_exists($this, $method)){
            return $this->$method($goods);
        }
        return $goods;
    }

}
