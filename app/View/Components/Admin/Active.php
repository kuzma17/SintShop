<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Active extends Component
{
    public $text;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($status)
    {
        if ($status == 1){
            $this->class = 'text-bg-success';
            $this->text = 'ON';
        }else{
            $this->class = 'text-bg-secondary';
            $this->text = 'OFF';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.active');
    }
}
