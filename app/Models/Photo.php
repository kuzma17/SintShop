<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    use Locale;

    protected $fillable = [
        'good_id',
        'src',
        'title_ru',
        'title_ua'
    ];

}
