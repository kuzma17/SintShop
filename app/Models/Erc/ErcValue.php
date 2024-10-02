<?php

namespace App\Models\Erc;

use App\Models\ValueAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErcValue extends Model
{
    use HasFactory;

    public function valueAttribute()
    {
        return $this->belongsTo(ValueAttribute::class, 'value_id', 'id');
    }
}
