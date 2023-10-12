<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Status extends Component
{
    public $text;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($status)
    {

        $this->text = $status->title_ru;

        if ($status->id == 1){
            $this->class = 'text-bg-danger';
        }else{
            $this->class = 'text-bg-secondary';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.status');
    }
}
