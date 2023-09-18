<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Sort extends Component
{
    public $route;
    public $sort;
    /**
     * Create a new component instance.
     */
    public function __construct(Request $request,$category)
    {
       $this->route = $this->getUrlPatch($request);
       $this->sort = $request->query->get('sort', env('SORT_DEFAULT'));
    }

    protected function getUrlPatch($request)
    {
        $search = $request->query('search');
        if ($search){
            return route('search').'?search='.$search.'&sort=';
        }

        return url()->current().'?sort=';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort');
    }
}
