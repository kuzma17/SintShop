<?php

namespace App\Models;

use App\Traits\Locale;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Good extends Model
{
    use HasFactory;
    use Locale;
    use Searchable;
    use Slug;

    protected $fillable = [
        'id',
        'code',
        'title_ru',
        'title_ua',
        'description_ru',
        'description_ua',
        'category_id',
        'vendor_id',
        'price',
        'quantity',
        'slug',
        'action',
        'sale',
        'active',
        'erc'
    ];

    protected $casts = [
        'active' => 'integer',
    ];

    protected $attributes = [
        'active' => 0
    ];

    public function toSearchableArray()
    {
        return $this->only([
            'id',
            'code',
            'title_ru',
            'title_ua',
            'description_ru',
            'description_ua',
        ]);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function valueAttributes(){
        return $this->belongsToMany(ValueAttribute::class);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSale($query){
        return $query->where('sale', 1);
    }

    public function scopeVisibleNull($query){
        return $query->where('quantity', '>', 0);
    }

    public function scopeSortQuantity($query){
        return $query->orderBy('quantity', 'DESC');
    }

    public function scopeSortDesc($query){
        return $query->orderBy('updated_at', 'DESC');
    }

    public function scopeErc($query)
    {
        return $query->where('erc', 1);
    }

    static public function getGood($slug){
        return self::where('slug', $slug)
            ->first()
            ->load('category','category.attribute','photos','videos','valueAttributes','valueAttributes.attribute');
    }

    public function getFirstPhotoAttribute(){
        return $this->photos->first();
    }

    public function getListValuesAttribure(){
        $values = $this->valueAttributes;

        $arr = [];

        foreach ($values as $value){
            $attribute = $value->attribute;


            if (!$attribute->active){
                continue;
            }

            if(!array_key_exists($attribute->id, $arr)) {

                if ($attribute->type_id === 3 || $attribute->type_id === 2){ // remove type 3, 2
                    continue;
                }

                $arr[$attribute->id] = [
                    'attribute' => $attribute->name,
                    'type' => $attribute->type_id,
                    'values' => $value->values
                ];

                if($attribute->type_id === 3) {

                    $arr[$attribute->id]['values'] = $value->values.' '.$attribute->format;
                }
                if($attribute->type_id === 4) {
                   // $arr[$attribute->id]['values'] = ($value->values === 1)? __('catalog.yes'): __('catalog.no');
                    $arr[$attribute->id]['values'] = __('catalog.yes');
                }
                continue;
            }

            if ($attribute->type_id === 1){
                $arr[$attribute->id]['values'] .= ', '.$value->values;

            }

        }
        ksort($arr);
        return $arr;
    }

    public function getValuesAttributes()
    {
        // Группируем сразу по attribute_id
        $groupedValues = $this->valueAttributes->groupBy('attribute_id');

        $arr = [];

        foreach ($groupedValues as $attributeId => $items) {
            // Берем первый элемент, чтобы получить тип атрибута
            $attribute = $items->first()->attribute;

            foreach ($items as $item) {
                if ($attribute->type_id === 2) {
                    $data = [
                        'string_ru' => $item->string_ru,
                        'string_ua' => $item->string_ua
                    ];
                } else {
                    $data = $item->values;
                }

                $arr[$attributeId][] = [
                    'id' => $item->id,
                    'values' => $data
                ];
            }
        }

        return $arr;
    }

    public function addValuesAttributes(){

        $value_set = [];
        $values = request()->values;
        if ($values){
            foreach ($values as $key => $value){
                $attribute = Attribute::find((int)$key);

                if ($attribute->type_id === 1 || $attribute->type_id === 4){
                    foreach ($value as $item){
                        $value_set[] = $item['id'];
                    }
                }else{
                    $value = $value[0];

//                    if ($attribute->type_id === 3){
//                        $value['float'] = $value['values'];
//                    }
//                    if ($attribute->type_id === 2){
//                        $value['string_ru'] = $value['values']['string_ru'];
//                        $value['string_ua'] = $value['values']['string_ua'];
//                    }
                    $val = $attribute->values()->updateOrCreate(['id' => $value['id']], $value);
                    $value_set[] = $val->id;
                }
            }
        }
        $this->valueAttributes()->sync($value_set);
    }

    public static function getSaleAllGoods()
    {
        return self::sale()->get();
    }

    public static function getSaleGoods()
    {
        return self::sale()->active()->get();
    }



}
