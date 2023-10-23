<?php

namespace App\View\Components\Admin;

use App\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewOrdersBadge extends Component
{
    public $orders = 0;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->orders = Order::where('status_id', 1)->get()->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.new-orders-badge');
    }
}
