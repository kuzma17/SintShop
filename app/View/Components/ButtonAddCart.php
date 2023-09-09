<?php

namespace App\View\Components;

use App\Cart\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonAddCart extends Component
{
    public $good;
    public $cart_good_qty;
    /**
     * Create a new component instance.
     */
    public function __construct(Cart $cart, $good)
    {
        $this->good = $good;
        $this->cart_good_qty = $cart->countItem($good->id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-add-cart');
    }
}
