@extends('layouts.page')

@section('title', __('seo.category_title', ['name' => $page->title ?? '']))
@section('keywords', __('seo.category_keywords', ['name' => $page->keywords ?? '']))
@section('description', __('seo.category_description', ['name' => $page->description ?? '']))

@section('link' ,Breadcrumbs::render('sale', $page))
@section('name_page', $page->name)

@section('body')

{{--    <x-sub-categories--}}
{{--            :category="$category"--}}
{{--    ></x-sub-categories>--}}

    @if($page->content)
        <collapse-text :text="{{json_encode($page->content)}}"></collapse-text>
    @endif

    <div class="sort-panel">
        <sort-goods></sort-goods>
    </div>

    <div class="row">
        <div class="col-12 col-md-3 p-1">
            <filter-goods
                    :attributes="{{json_encode($filters)}}"
                    :selected="{{json_encode(getParametersRequest())}}"
                    :min_price="{{$minPrice}}"
                    :max_price="{{$maxPrice}}"
                    container="#catalog"
                    preloader="#preloader"
            ></filter-goods>
        </div>
        <div class="col-12 col-md-9 p1">
            <div class="catalog">
                <div id="catalog" class="row justify-content-center">
                    @include('catalog.list', ['goods' => $goods])
                </div>
            </div>
        </div>
{{--        @if($category->content2)--}}
{{--            <collapse-text :text="{{json_encode($category->content2)}}"></collapse-text>--}}
{{--        @endif--}}
    </div>
@endsection
