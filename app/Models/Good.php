<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Good extends Model
{
    use HasFactory;
    use Locale;
    use Searchable;

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
        'active',
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

    public function scopeVisibleNull($query){
//        if (!config('visible_goods_null', true)){
            return $query->where('quantity', '>', 0);
//        }
//        return $query;
    }

    public function scopeForCategory($query, $category){
        return $query->where('category_id', $category->id);
    }

    public function scopeSortDesc($query){
        return $query->orderBy('updated_at', 'DESC');
    }

    public function getGood(){
        return $this->load('category','category.attribute','photos','videos','valueAttributes','valueAttributes.attribute');
    }

    public function getFirstPhotoAttribute(){
        return $this->photos->first();
    }

    public function listGoodAttributeValue(){
        $res = [];
        $values = $this->valueAttributes;

        foreach ($values as $value){

//            $res[$value->attribute->id]['attribute'] = $value->attribute->erc.' '.$value->attribute->name;
//            $res[$value->attribute->id]['values'][] = $value->value;

            if(isset($res[$value->attribute->id])){
                $res[$value->attribute->id]['values'] .= ', '.$value->value;
            }else{
               // $res[$value->attribute->id]['attribute'] = $value->attribute->erc.' '.$value->attribute->name;
                $res[$value->attribute->id]['attribute'] = $value->attribute->name;
                $res[$value->attribute->id]['values'] = $value->value;
            }
        }
        ksort($res);
        return $res;

//        return $this->valueAttributes->map(function ($value){
//            return  [
//                'attribute' => $value->attribute->name,
//                'value' => $value->value
//            ];
//        });
    }

}
