<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueAttribute extends Model
{
    use HasFactory;
    use Locale;

    protected $fillable = [
        'attribute_id',
        'value_ru',
        'value_ua',
        'erc'
    ];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

    public function goods(){
        return $this->belongsToMany(Good::class);
    }
}
