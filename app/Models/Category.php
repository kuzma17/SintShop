<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Locale;

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSort($query){
        return $query->orderBy('sort');
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
