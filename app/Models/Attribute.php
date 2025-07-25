<?php

namespace App\Models;

use App\Traits\Locale;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    use Locale;
    use Slug;

    protected $fillable = [
        'category_id',
        'slug',
        'type_id',
        'filter',
        'name_ru',
        'name_ua',
        'format',
        'active',
        'sort',
        'erc'
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeFilter($query)
    {
        return $query->where('filter', 1);
    }

    public function scopeSort($query)
    {
        return $query->orderBy('sort');
    }

    public function scopeSortDesc($query){
        return $query->orderBy('updated_at', 'DESC');
    }

    public function values(){
        return $this->hasMany(ValueAttribute::class)
            ->where('active', 1)
            ->orderBy('sort');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function type(){
        return $this->belongsTo(TypeAttribute::class, 'type_id');
    }

    public function getValues(){

        if ($this->type_id === 1) {
            $str = '';
            foreach ($this->values as $value){
                $str .= $value->string.', ';
            }

            $str = trim($str, ', ');

            return $str;
        }elseif ($this->type_id === 2){
            return $this->values[0]->string;
        }elseif($this->type_id === 3){
            $val = $this->values[0]->float;
            return $this->format? $val.' '.$this->format: $val;
        }elseif ($this->type_id === 4){
            if ($this->values[0]->boolean){
                return 'YES';
            }
            return 'No';
        }
    }

    public function addValues($request){

        if ($request->type_id != $request->prev_type_id){

            $this->values()->delete(); // Delete
        }

        if ($request->type_id == 1 && $request->values) {

            $toKeep = array_map(function ($itrm){
                return $itrm['id'];
                }, $request->values);

            $this->values()->whereNotIn('id',$toKeep)->delete();

            foreach ($request->values as $value) {
                $this->values()->updateOrCreate(['id' => $value['id']], $value);
            }
        }elseif($request->type_id == 4){

            $this->values()->firstOrCreate(['float' => 1]);
        }
    }


}
