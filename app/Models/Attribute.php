<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    use Locale;

    protected $fillable = [
        'slug',
        'type',
        'filter',
        'name_ru',
        'name_ua',
        'active',
        'erc'
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function values(){
        return $this->hasMany(ValueAttribute::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }


}
