<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Locale;

    protected $fillable = [
        'slug',
        'name_ru',
        'name_ua',
        'title_ru',
        'description_ru',
        'keywords_ru',
        'title_ua',
        'description_ua',
        'keywords_ua',
        'content_ru',
        'content_ua',
        'active',
    ];


    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public static function getPage($slug){
        return self::where('slug', $slug)->first();
    }

}
