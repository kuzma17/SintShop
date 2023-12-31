<?php

namespace App\View\Components;

use App\Cart\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartIcon extends Component
{
    public $count;
    /**
     * Create a new component instance.
     */
    public function __construct(Cart $cart)
    {
        $this->count = $cart->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-icon');
    }
}
