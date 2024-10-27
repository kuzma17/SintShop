<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    use Locale;

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSort($query){
        return $query->orderBy('sort');
    }

    public static function getDeliveries(){
        return self::active()
            ->sort()
            ->get();
    }
}
