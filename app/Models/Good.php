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

    public function toSearchableArray()
    {
        return $this->only([
            'id',
            'code',
            'title_ru',
            'title_ua',
            'description_ru',
            'description_ua'
        ]);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
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

    public function getGood(){
        return $this->load('category','photos');
    }


}
