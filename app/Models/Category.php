<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Locale;

    protected $fillable = [
        'parent_id',
        'slug',
        'title_ru',
        'description_ru',
        'keywords_ru',
        'title_ua',
        'description_ua',
        'keywords_ua',
        'content_ru',
        'content_ua',
        'image',
        'icon',
        'sort',
        'filter'
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSort($query){
        return $query->orderBy('sort');
    }

    public function scopeSortDesc($query){
        return $query->orderBy('updated_at', 'DESC');
    }

    public function goods(){
        return $this->hasMany(Good::class)
            ->active()
            ->visibleNull();
    }

    public function getCategories(){
        return self::active()
            ->sort()
            ->get();
    }

    public function getParent(){
        return self::getCategories()
            ->where('id', $this->parent_id)
            ->first();
    }

    public function getGoodsCategory(){
        return Good::forCategory($this)
            ->active()
            //->visibleNull()
            //->sort()
            ->get()
            ->load('photos');
    }

}
