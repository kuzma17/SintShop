<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Existence extends Component
{
    public $good;
    /**
     * Create a new component instance.
     */
    public function __construct($good)
    {
        $this->good = $good;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.existence');
    }
}
