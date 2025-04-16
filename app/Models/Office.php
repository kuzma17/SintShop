<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Office extends Model
{
    use HasFactory;
    use Locale;

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSort($query){
        return $query->orderBy('sort');
    }

    public static function getOffices()
    {
        return Cache::rememberForever('offices.active.sorted', function () {
            return self::active()
                ->sort()
                ->get();
        });

    }
}
