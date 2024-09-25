<?php

namespace App\Services;

use DB;
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

    protected function vendor($values)
    {
        $this->query = $this->query->whereIn('vendor_id', $values);
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
        return $arr;

    }

    public function apply($query){

        $this->query = $query;

        if (count($this->parameters) === 0){
            return $this->query;
        }

        if (isset($this->parameters['price'])){
            $this->price($this->getValue($this->parameters['price']));
            unset($this->parameters['price']);
        }

        if (isset($this->parameters['vendor'])){
            $this->vendor($this->getValue($this->parameters['vendor']));
            unset($this->parameters['vendor']);
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

        $this->filters($values);

        return $this->query;
    }

    public function getCountAttributes()
    {
        if (!$this->query){
            return false;
        }

        $queryVendor = clone $this->query;
        $queryAttribute = clone $this->query;

        $countVendors = $queryVendor->select('vendor_id as id', DB::raw('COUNT(vendor_id) as count'))
            ->groupBy('vendor_id')
            ->get();

        $countAttributes = $queryAttribute->leftJoin('good_value_attribute as v', 'goods.id', '=', 'v.good_id')
            ->select('v.value_attribute_id as id', DB::raw('COUNT(v.value_attribute_id) as count'))
            ->groupBy('v.value_attribute_id')
            ->get();

        return [
            'vendor' => $countVendors,
            'attributes' => $countAttributes
        ];

    }

}