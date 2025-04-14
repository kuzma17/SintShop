<?php

namespace App\View\Components;

use App\Http\Resources\OfficeResource;
use App\Models\Office;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OfficeList extends Component
{

    public $offices;
    /**
     * Create a new component instance.
     */
    public function __construct(Office $office)
    {
        $this->offices = OfficeResource::collection($office->getOffices());

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.office-list');
    }
}
