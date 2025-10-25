<?php

namespace App\Services;

use App\Cart\Cart;
use App\Models\Good;
use Illuminate\Http\Request;

class CartService
{
    protected $cart;
    public function __construct(Cart $cart){
        $this->cart = $cart;
    }

    public function add(Request $request){
        return $this->cart->add($request->id, $request->qty, $request->price);

    }

    public function update(Request $request){
        return $this->cart->update($request->id, $request->qty);
    }

    public function getGoods(){

        $content = $this->content();

        return $content->map(function ($item){
            $good = Good::find($item->id)->load('photos', 'category');

            $photo = $good->first_photo? '/images/goods/'.$good->first_photo->src: '/images/no_photo.jpg';

            return [
                'id' => $good->id,
                'slug' => $good->slug,
                'name' => $good->title,
                'code' => $good->code,
                'qty' => $item->qty,
                'price' => $item->price,
                'photo' => asset($photo),
                'category' => [
                    'name' => $good->category->name,
                    'slug' => $good->category->slug,
                ]
            ];
        });
    }

    public function content(){
        return $this->cart->content();
    }

    public function count(){
        return $this->cart->count();
    }

    public function total(){
        return $this->cart->total();
    }

    public function totalFloat(){
        return $this->cart->totalFloat();
    }

    public function remove(Request $request){
        $this->cart->remove($request->id);
    }

    public function destroy(){
        $this->cart->destroy();
    }

}
