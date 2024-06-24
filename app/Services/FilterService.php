<?php

namespace App\Services;

use Illuminate\Http\Request;

class FilterService
{
    public $parameters;

    protected $query;

    public function __construct(Request $request){

        $this->parameters = $this->getParameters($request);
    }

    protected function getParameters($request){
        return $request->query->all();
    }

    protected function price($value){
        $min = (float)$value[0];
        $max = (float)$value[1];
        $this->query = $this->query->where('price', '>=', $min)->where('price', '<=', $max);
    }


    protected function getValue($value)
    {
        $arr = explode(',', $value);
        if (count($arr) > 1){
           return $arr;
        }

        return $value;

    }

    public function apply($query){

        $this->query = $query;

        foreach ($this->parameters as $key => $val){

            if ($val){
                if(method_exists($this, $key)){
                    $this->$key($this->getValue($val));
                }
            }
        }
        return $this->query;
    }

}