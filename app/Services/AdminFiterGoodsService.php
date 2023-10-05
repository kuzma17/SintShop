<?php

namespace App\Services;

use Illuminate\Http\Request;

class AdminFiterGoodsService
{
    public $parameters;

    protected $query;

    public function __construct(Request $request){

        $this->parameters = $this->getParameters($request);
    }

    protected function getParameters($request){
        return $request->query->all();
    }

    protected function id($id){
        $this->query = $this->query->where('id', $id);
    }

    protected function category($category_id){
        $this->query = $this->query->where('category_id', $category_id);
    }

    protected function slug($slug){
        $this->query = $this->query->where('slug', $slug);
    }

    protected function code($code){
        $this->query = $this->query->where('code', $code);
    }

    protected function title($title){
        $this->query = $this->query->where('title_ru', 'LIKE', '%'.$title.'%');
    }




    public function apply($query){

        $this->query = $query;

        foreach ($this->parameters as $key => $val){

           // dd($key.' '.$val);

            if ($val){

                if(method_exists($this, $key)){
                    $this->$key($val);
                }
            }
        }

        return $this->query;

    }



}
