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
        $parameters = $request->query->all();
        unset($parameters['page']);
        unset($parameters['sort']);
        return $parameters;
    }

    protected function price($value){
        $min = (float)$value[0];
        $max = (float)$value[1];
        $this->query = $this->query->where('price', '>=', $min)->where('price', '<=', $max);
    }

    protected function filters($values)
    {
        return $this->query->whereHas('valueAttributes', function ($query) use ($values) {
            $query->whereIn('id', $values);
        });

    }

    protected function getValue($value)
    {
        $arr = explode(',', $value);
//        if (count($arr) > 1){
//           return $arr;
//        }

        return $arr;

    }

    public function apply($query){

        $this->query = $query;

        if (count($this->parameters) === 0){
            return $this->query;
        }

//        foreach ($this->parameters as $key => $val){
//
//            if ($val){
//                if(method_exists($this, $key)){
//                    $this->$key($this->getValue($val));
//                }
//            }
//        }


        if (isset($this->parameters['price'])){
            $this->price($this->getValue($this->parameters['price']));
            unset($this->parameters['price']);
        }

        if (count($this->parameters) === 0){
            return $this->query;
        }

        $values = [];
        foreach ($this->parameters as $key => $val){
            if ($val){
                $values = array_merge($values, $this->getValue($val));
            }
        }

       // if (count($values) > 0){
            $this->filters($values);
       // }

        return $this->query;
    }

}