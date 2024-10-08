<?php

namespace App\Models\Erc;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErcAttribute extends Model
{
    use HasFactory;

    public function attributeGood()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
