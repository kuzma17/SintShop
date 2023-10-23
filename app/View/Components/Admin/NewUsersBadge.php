<?php

namespace App\View\Components\Admin;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewUsersBadge extends Component
{
    public $users = 0;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $date = now()->modify('-7 day');
        $this->users = User::where('created_at', '<', $date)->get()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.new-users-badge');
    }
}
