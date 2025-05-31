@extends('layouts.page')

@section('title', __('seo.category_title', ['name' => 'Sale']))
@section('keywords', __('seo.category_keywords', ['name' => 'Sale']))
@section('description', __('seo.category_description', ['name' => 'Sale']))

{{--@section('link' ,Breadcrumbs::render('catalog', $category))--}}
@section('name_page', 'Sale')

@section('body')

{{--    <x-sub-categories--}}
{{--            :category="$category"--}}
{{--    ></x-sub-categories>--}}

{{--    @if($category->content)--}}
{{--        <collapse-text :text="{{json_encode($category->content)}}"></collapse-text>--}}
{{--    @endif--}}

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
