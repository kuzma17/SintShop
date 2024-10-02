<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardGood extends Component
{
    public $good;
    public $countRow = 4;
    /**
     * Create a new component instance.
     */
    public function __construct($good, $type='catalog')
    {
        $this->good = $good;

        if($type === 'new'){
            $this->countRow = 3;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-good');
    }
}
