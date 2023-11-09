<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'good_id',
        'youtube_id',
        'active'
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
