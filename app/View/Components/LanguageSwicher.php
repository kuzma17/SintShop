<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LanguageSwicher extends Component
{
    public $locale;
    public $url;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->locale = app()->getLocale();
        $this->url = $this->getUrl($this->locale);
    }

    protected function getUrl($locale)
    {
        $uri = request()->path();
        $segments = explode('/', $uri);

        if ($segments[0] == "ru") {
            array_shift($segments);
        }

        if ($locale === 'ua') {
            $newPath = '/ru/' . implode('/', $segments);
        } else {
            $newPath = implode('/', $segments);
        }

        $query = request()->getQueryString();
        return url($newPath) . ($query ? '?' . $query : '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.language-swicher');
    }
}
