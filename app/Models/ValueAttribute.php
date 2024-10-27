<?php

namespace App\Models;

use App\Traits\Locale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ValueAttribute extends Model
{
    use HasFactory;
    use Locale;

    protected $fillable = [
        'attribute_id',
        'slug',
        'string_ru',
        'string_ua',
        'float',
        'sort',
        'active',
        'erc',
    ];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

    public function goods(){
        return $this->belongsToMany(Good::class);
    }

    public function getValuesAttribute()
    {
//        if ($this->attribute->type_id === 1 || $this->attribute->type_id === 2){
//            return $this->string;
//        }else{
//            return $this->float;
//        }

        if ($this->attribute->type_id === 1 || $this->attribute->type_id === 2){
            return $this->string;
        }elseif($this->attribute->type_id === 4){
            return __('catalog.yes');
        }else{
            return $this->float;
        }
    }

    public function setValuesAttribute($value){

        if (is_array($value)){
            $this->attributes['string_ru'] = $value['string_ru'];
            $this->attributes['string_ua'] = $value['string_ua'];
        }else{
            $this->attributes['float'] = $value;
        }
    }
}
