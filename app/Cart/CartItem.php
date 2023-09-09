<?php

namespace App\Cart;

class CartItem{

    public $id;
    public $qty;
    public $price;
    public $options;

    public function __construct($id, $qty, $price, $options){

        $this->id = $id;
        $this->qty = $qty;
        $this->price = floatval($price);
        $this->options = new CartItemOptions($options);

    }

    public function total(){
        return $this->price * $this->qty;
    }

    protected function generateRowId($id, array $options){
     //   ksort($options);

        return md5($id);
    }

    public function setQuantity($qty){
        if (empty($qty) || !is_numeric($qty)) {
            throw new \InvalidArgumentException('Please supply a valid quantity.');
        }

        $this->qty = $qty;
    }

}
