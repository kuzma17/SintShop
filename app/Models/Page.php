<?php

namespace App\Models;

use App\Traits\Locale;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Locale;
    use Slug;

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
        'content2_ru',
        'content2_ua',
        'image',
        'callback',
        'active',
    ];


    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public static function getPage($slug){
        return self::where('slug', $slug)->first();
    }

}
