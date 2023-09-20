<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Locale;

    public function getPage($slug){
        return self::where('slug', $slug)->first();
    }
}
