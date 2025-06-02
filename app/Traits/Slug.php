<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slug
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $slug = Str::slug($model->name_ru ?? $model->title_ru);
                $originalSlug = $slug;
                $i = 1;
                while (self::where('slug', $slug)->where('id', '!=', $model->id)->exists()) {
                    $slug = $originalSlug . '-' . $i++;
                }
                $model->slug = $slug;
            }
        });
    }

}