<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    use Locale;

    protected $table = 'seo_meta';
    protected $fillable = [
        'route',
        'locale',
        'meta_title_ru',
        'meta_title_ua',
        'meta_description_ru',
        'meta_description_ua',
        'meta_keywords_ru',
        'meta_keywords_ua',
        'og_title_ru',
        'og_title_ua',
        'og_description_ru',
        'og_description_ua',
        'og_image',
        'canonical_url',
        'noindex',
        // seoable_type, seoable_id — если используются
    ];

    public function seoable()
    {
        return $this->morphTo();
    }

    public function scopeUrl($query)
    {
        return $query->where('route', request()->url());
    }
}
