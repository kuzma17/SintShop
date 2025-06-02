<?php

namespace App\Models;

use App\Traits\Locale;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Locale;
    use Slug;

    protected $fillable = [
        'parent_id',
        'slug',
        'name_ru',
        'name_ua',
        'title_ru',
        'description_ru',
        'keywords_ru',
        'title_ua',
        'description_ua',
        'keywords_ua',
        'content_ru',
        'content_ua',
        'content2_ru',
        'content2_ua',
        'image',
        'icon',
        'sort',
        'filter',
        'active',
    ];

    public function attribute(){
        return $this->hasMany(Attribute::class);
    }

    public function filters()
    {
        return $this->attribute()->filter()->sort();
    }

    public function vendorValues()
    {
        return $this->belongsToMany(Vendor::class);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSort($query){
        return $query->orderBy('sort');
    }

    public function scopeSortDesc($query){
        return $query->orderBy('updated_at', 'DESC');
    }

    public function goods(){
        return $this->hasMany(Good::class)
            ->active();
    }

    public function saleGoods()
    {
        return $this->goods()->sale();
    }

    public function getParent(){
        return self::getCategories()
            ->where('id', $this->parent_id)
            ->first();
    }

    public function getGoodsCategory(){
        return Good::forCategory($this)
            ->active()
            //->visibleNull()
            //->sort()
            ->get()
            ->load('photos', 'valueAttributes');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getAllCategories(){
        return self::with('children')
            ->whereNull('parent_id')
            ->sort()
            ->get();
    }

    public function getCategories(){

        if ($this->exists){
            $query = $this->children();
        }else{
            $query = self::whereNull('parent_id');
        }

        return $query->active()
            ->sort()
            ->get();
    }

    public function getAllFilters()
    {
        $model = new Attribute([
            'slug' => 'vendor',
            'name_ru' => 'Производитель',
            'name_ua' => 'Бренд',
        ]);

        $model->values = $this->vendorValues;
        $VendorAttribute = collect([$model]);

        return $VendorAttribute->concat($this->filters);

    }

    static public function getCategory($slug)
    {
        return self::where('slug', $slug)
            ->first();
    }

}
