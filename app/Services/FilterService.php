<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Vendor;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FilterService
{
    public $parameters;

    protected $query;
    protected $countAttributes;

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

    protected function category($values)
    {
        $this->query = $this->query->whereIn('category_id', $values);
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

        if (isset($this->parameters['category'])){
            $this->category($this->getValue($this->parameters['category']));
            unset($this->parameters['category']);
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

        if ($this->countAttributes){
            return $this->countAttributes;
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

        $this->countAttributes = [
            'vendor' => $countVendors,
            'attributes' => $countAttributes
        ];

        return  $this->countAttributes;


    }

    public function getFilters(Category $category)
    {
        return Cache::rememberForever('filter_'.app()->getLocale().$category->id, function () use ($category) {

            $category = $category->load('filters', 'filters.values', 'filters.type', 'filters.values.attribute');
            $data = $category->getAllFilters();

            return $data->map(function ($item) {
                return [
                    'slug' => $item->slug,
                    'name' => $item->name,
                    'values' => $item->values->map(function ($val) use ($item) {

                        $type = 'attributes';
                        if ($item->slug === 'vendor') {
                            $type = 'vendor';
                        }

                        return [
                            'id' => $val->id,
                            'values' => $val->values,
                            'count' => $this->getCountValues($type, $val->id),
                        ];

                    })
                ];
            });

        });

    }

    public function getSaleFilter()
    {
        $model1 = new Attribute([
            'slug' => 'vendor',
            'name_ru' => 'Производитель',
            'name_ua' => 'Бренд',
        ]);
        $model1->values = Vendor::withCount('saleGoods')->get();

        $model2 = new Attribute([
            'slug' => 'category',
            'name_ru' => 'Тип товара',
            'name_ua' => 'Тип товару',
        ]);
        $model2->values = Category::withCount('saleGoods')->active()->get();

        $data = collect([$model1, $model2]);

        return $data->map(function ($item) {
            return [
                'slug' => $item->slug,
                'name' => $item->name,
                'values' => collect($item->values)->map(function ($val) use ($item) {
                    return [
                        'id' => $val['id'] ?? null,
                        'values' => $val['values'] ?? $val['name'],
                        'count' => $val['sale_goods_count'],
                    ];
                })
            ];
        });
    }

    protected function getCountValues($type, $id)
    {
        $result = $this->getCountAttributes()[$type]->where('id', $id)->first();
        if ($result){
            return $result->count;
        }
        return 0;
    }

}