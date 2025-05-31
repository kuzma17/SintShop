<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image'
    ];

    public function getValuesAttribute()
    {
        return $this->title;
    }

    public function goods()
    {
        return $this->hasMany(Good::class)
            ->active();;
    }

    public function saleGoods()
    {
        return $this->goods()->sale();
    }

}
