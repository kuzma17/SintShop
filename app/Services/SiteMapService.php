<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Good;
use App\Models\Page;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SiteMapService
{

    protected function getRuUrl($route)
    {
        $parse = parse_url($route, PHP_URL_PATH);
        return '/ru'.$parse;

    }

    protected function homePage($map)
    {
        return $map->add(Url::create(route('home'))
            ->addAlternate($this->getRuUrl(route('home')), 'ru')
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.5));

    }

    protected function pages($map)
    {
        $pages = Page::active()->get(['id', 'slug']);

        foreach ($pages as $page){
            $route = route('page', [$page->slug]);
            $map->add(Url::create($route)
                ->addAlternate($this->getRuUrl($route), 'ru')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.5));

        }

        return $map;
    }

    protected function categories($map)
    {
        $categories = Category::active()->get(['id', 'slug']);

        foreach ($categories as $category){
            $route = route('catalog', [$category->slug, $category->id]);
            $map->add(Url::create($route)
                ->addAlternate($this->getRuUrl($route), 'ru')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.2));

        }

        return $map;
    }

    protected function goods($map)
    {

        $goods = Good::active()->get(['id', 'slug']);

        foreach ($goods as $good){
            $route = route('good', [$good->slug, $good->id]);
            $map->add(Url::create($route)
                ->addAlternate($this->getRuUrl($route), 'ru')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.1));
        }

        return $map;
    }

    public function generateMap()
    {

        $map = Sitemap::create();
        $map = $this->homePage($map);
        $map = $this->pages($map);
        $map = $this->goods($map);

        $map->writeToFile(public_path('sitemap.xml'));

    }

}