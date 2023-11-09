<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class AdminFilterService
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

    protected function phone($phone){

        $user = User::findUser($phone);

        if ($user){
            $this->query = $this->query->where('user_id', $user->id);
        }else{
            $this->query = $this->query->where('user_id', 'none');
        }
    }

    protected function user_phone($phone){

        $phone = cleanPhone($phone);
        $this->query = $this->query->where('phone', $phone);
    }

    protected function status($status_id){
        $this->query = $this->query->where('status_id', $status_id);
    }

    protected function created_at($date){

        if ($date == 'all'){
            return;
        }elseif($date == 'today'){
            $sing = '=';
            $date_created = now();
        }else{
            $sing = '>=';
            $arr = explode('_', $date);
            $date_created = now()->modify('-'.$arr[1].' '.$arr[0]);
        }

        $this->query = $this->query->whereDate('created_at', $sing, $date_created->format('Y-m-d'));
    }

    protected function name($name){

        $this->query = $this->query->where('name', 'LIKE', '%'.$name.'%');
    }


    public function apply($query){

        $this->query = $query;

        foreach ($this->parameters as $key => $val){
            if ($val){
                if(method_exists($this, $key)){
                    $this->$key($val);
                }
            }
        }
        return $this->query;
    }



}
