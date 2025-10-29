<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Seo;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SeoService
{
    public function __construct(protected UrlGenerator $url) {}

    public function generateTable()
    {
        $pages = Post::all();

        foreach ($pages as $page){

            $page->seo()->create([
                //'locale' => 'ru',
                'meta_title_ru' => $page->title_ru_ ? $page->title_ru_: $page->name_ru,
                'meta_description_ru'=> $page->description_ru_,
                'meta_keywords_ru' => $page->keywords_ru_,
                'meta_title_ua' => $page->title_ua_ ? $page->title_ua_ : $page->name_ua,
                'meta_description_ua'=> $page->description_ua_,
                'meta_keywords_ua' => $page->keywords_ua_,
            ]);

        }

    }

    /**
     *
     * @param object|null $model  — экземпляр Page|Post|Category|Good или null
     * @return array
     */
    public function getFor($model = null): array
    {

        $cacheKey = $this->cacheKey($model);
        return Cache::remember($cacheKey, now()->addMinutes(30), fn() => $this->build($model));
        //return $this->build($model);
    }

    protected function build($model): array
    {
        // Если модель — товар (Good)
        if ($model && $this->isGood($model)) {
            return $this->buildForGood($model);
        }

        // Если модель — пост или страница
        if ($model && $this->isPostOrPage($model)) {
            return $this->buildForArticle($model);
        }

        // Если категория
        if ($model && $this->isCategory($model)) {
            return $this->buildForCategory($model);
        }

        // Фолбэк: берем запись из seo_meta по route+locale или дефолты из lang
        return $this->buildDefault();
    }

    protected function buildForGood($good): array
    {
        $title = __('seo.good_title', ['name' => $good->title]);
        $description = __('seo.good_description', ['name' => $good->title]);
        $keywords = __('seo.good_keywords', ['name' => $good->title]);
        $image = $this->getImageFromModel($good) ?? $this->absoluteAsset(config('seo.logo'));


        $jsonLd = $this->productSchema($good, $description, $image);

        return $this->baseResult($title, $description, $keywords, $image, $jsonLd);
    }

    protected function buildForArticle($model): array
    {

        $seoRelation = $model->seo ? $model->seo: null;

        $title = $seoRelation?->meta_title ?? ($model->name ? __('seo.article', ['name'=> $model->name]) : config('seo.name'));
        $description = $seoRelation?->meta_description
            ?? ($model->meta_description
                ?? Str::limit(
                    preg_replace('/\s+/', ' ', strip_tags(trim($model->content ?? $model->body ?? ''))),
                    160
                ));

        $keywords = $seoRelation?->meta_keywords ?? __('seo.site_keywords');
        $ogImage = $seoRelation?->og_image ? $this->absoluteAsset($seoRelation->og_image) : ($this->getImageFromModel($model) ?? $this->absoluteAsset(config('seo.logo')));

        $jsonLd = $this->articleSchema($model, $description, $ogImage);

        return $this->baseResult(
            $title, $description, $keywords, $ogImage, $jsonLd, $seoRelation
        );
    }

    protected function buildForCategory($category): array
    {
        $title = __('seo.category_title', ['name' => $category->name]);
        $description = __('seo.category_description', ['name' => $category->name]);
        $keywords = __('seo.category_keywords', ['name' => $category->name]);
        $image = $this->getImageFromModel($category) ?? $this->absoluteAsset(config('seo.logo'));
        $jsonLd = $this->organizationSchema();

        return $this->baseResult($title, $description, $keywords,$image, $jsonLd);
    }

    protected function buildDefault(): array
    {

        $seo = Seo::url()->first();

        $title = $seo->meta_title ?? __('seo.site_title');
        $description = $seo->meta_description ?? __('seo.site_description');
        $keywords = __('seo.site_keywords');
        $ogImage = $seo?->og_image ? $this->absoluteAsset($seo->og_image) : $this->absoluteAsset(config('seo.logo'));

        $jsonLd = $this->organizationSchema();

        return $this->baseResult(
            $title, $description, $keywords, $ogImage, $jsonLd
        );
    }

    protected function baseResult($title, $description, $keywords, $image, $jsonLd, $seoModel = null): array
    {
        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'og_title' => $seoModel->og_title ?? $title,
            'og_description' => $seoModel->og_description ?? $description,
            'image' => $image,
            'url' => $seoModel->canonical_url ?? $this->url->current(),
            'noindex' => (bool) ($seoModel->noindex ?? false),
            'json_ld' => json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ];
    }

    protected function isGood($m): bool
    {
        return $m::class === \App\Models\Good::class || $m instanceof \App\Models\Good;
    }

    protected function isPostOrPage($m): bool
    {
        return $m instanceof \App\Models\Post || $m instanceof \App\Models\Page;
    }

    protected function isCategory($m): bool
    {
        return $m instanceof \App\Models\Category;
    }

    protected function cacheKey($model): string
    {
        $route = request()->route()?->getName() ?? 'no-route';
        $id = $model && isset($model->id) ? $model->id : 'none';
        return "seo:{$route}:" . app()->getLocale() . ":{$id}";
    }

    protected function absoluteAsset(string $path): string
    {
        //return str_starts_with($path, 'http') ? $path : $this->url->to($path);
        return asset($path);
    }

    public function getImageFromModel($model): ?string
    {
        if (! $model) return null;

        $img = $model->getAttribute('image') ?? ($model->image ?? null);
        if ($img) return $this->absoluteAsset('/images/post/'.$img);

        if (method_exists($model, 'photo') && $model->photo) {
            $img = $model->photo ? '/images/goods/'.$model->photo->src : null;
            if ($img) return $this->absoluteAsset($img);
        }

        return null;
    }

    // -------------------------
    // JSON-LD
    // -------------------------
    protected function organizationSchema(): array
    {
        $cfg = config('seo');
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $cfg['name'],
            'url' => $cfg['url'],
            'logo' => $this->absoluteAsset($cfg['logo']),
            'contactPoint' => [
                [
                    '@type' => 'ContactPoint',
                    'telephone' => $cfg['phone'],
                    'contactType' => 'Customer Service',
                ]
            ],
            'sameAs' => $cfg['same_as'],
        ];
    }

    protected function productSchema($good, $description, $image): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $good->title,
            'image' => [$image],
            'description' => $description,
            'sku' => $good->sku ?? null,
            'offers' => [
                '@type' => 'Offer',
                'url' => $this->url->current(),
                'priceCurrency' => $good->currency ?? 'UAH',
                'price' => $good->price ?? null,
                'availability' => $good->in_stock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            ],
        ];
    }

    protected function articleSchema($model, $description, $image): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'mainEntityOfPage' => $this->url->current(),
            'headline' => $model->name ?? null,
            'image' => [$image],
            'datePublished' => $model->created_at?->toIso8601String(),
            'dateModified' => $model->updated_at?->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $model->author->name ?? config('seo.name'),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('seo.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $this->absoluteAsset(config('seo.logo')),
                ]
            ],
            'description' => $description,
        ];
    }

}