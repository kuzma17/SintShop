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
    public function getSort(Request $request){

        return $request->query->get('sort');
    }

    public function new($goods, $path=null){
        return $goods->sortByDesc('create_at');
    }

    public function priceAsc($goods){
        return $goods->sortBy('price');
    }

    public function priceDesc($goods){
        return $goods->sortByDesc('price');
    }

    public function apply($goods){
        $method = $this->sort;

        if(method_exists($this, $method)){
            return $this->$method($goods);
        }
        return $goods;
    }

}
