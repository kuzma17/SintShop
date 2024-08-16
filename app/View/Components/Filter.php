<?php

namespace App\View\Components;

use App\Http\Resources\AttributeFilterResource;
use App\Models\Attribute;
use App\Models\Category;
use Cache;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    protected $category;
    public $filters;
    public $selected;
    public $min_price = 0;
    public $max_price = 0;
    /**
     * Create a new component instance.
     */
    public function __construct(Category $category, $minPrice, $maxPrice)
    {
        $this->category = $category->load('filters', 'filters.values', 'filters.type', 'filters.values.attribute');

        $this->filters = $this->getFilters();
        $this->selected = getParametersRequest();
        $this->min_price = (float)$minPrice;
        $this->max_price = (float)$maxPrice;
    }

    protected function getAttributeVendor()
    {
        $model = new Attribute([
            'slug' => 'vendor',
            'name_ru' => 'Производитель',
            'name_ua' => 'Бренд',
        ]);

        $model->values = $this->category->vendorValues;
        return collect([$model]);
    }

    protected function getFilters()
    {
        return Cache::rememberForever('filter_'.app()->getLocale().$this->category->id, function (){

            $VendorAttribute = $this->getAttributeVendor();
            $data = $VendorAttribute->concat($this->category->filters);

            //return AttributeFilterResource::collection($data);

            return $data->map(function ($item){
                return [
                    'slug' => $item->slug,
                    'name' => $item->name,
                    'values' => $item->values->map(function ($val) {
                            return [
                                'id' => $val->id,
                                'values' => $val->values,
                                ];
                    })
                ];
            });

        });

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter');
    }
}
