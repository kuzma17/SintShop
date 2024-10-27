<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    public $sliders;
    public $locale;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->sliders = ['epson_banner','slider_banner1','slider_banner2','slider_banner3','slider_banner4'];
        $this->locale = app()->getLocale();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.slider');
    }
}
