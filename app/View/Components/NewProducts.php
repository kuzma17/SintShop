<?php

namespace App\View\Components;

use App\Models\Good;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewProducts extends Component
{
    public $goods;
    /**
     * Create a new component instance.
     */
    public function __construct(Good $good)
    {

        $this->goods = $good->visibleNull()
            ->where('created_at', '>=', now()->subDays(3)->startOfDay()) // С начала трех дней назад
            ->where('created_at', '<=', now()) // До текущего момента
            ->inRandomOrder() // Случайный порядок
            ->limit(12)
            ->get()
            ->load('photos');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.new-products');
    }
}
