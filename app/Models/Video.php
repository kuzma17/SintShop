<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'good_id',
        'youtube',
        'active'
    ];

    protected $casts = [
        'active' => 'integer',
    ];

    protected $attributes = [
        'active' => 0
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
