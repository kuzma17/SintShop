<?php

namespace App\View\Components;

use App\Services\SeoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoBlock extends Component
{
    public array $data;

    public function __construct($model = null)
    {
        $this->data = app(SeoService::class)->getFor($model);
    }

    public function render()
    {
        return view('components.seo-block', $this->data);
    }
}
