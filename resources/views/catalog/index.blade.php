@extends('layouts.page')

@php($seo = $category)

@section('link' ,Breadcrumbs::render('catalog', $category))
@section('name_page', $category->name)

@section('body')

    <x-sub-categories
            :category="$category"
    ></x-sub-categories>

    @if($category->content)
       <collapse-text :text="{{json_encode($category->content)}}"></collapse-text>
    @endif

    <div class="row">
        <div class="sort-panel_">
            <sort-goods></sort-goods>
        </div>
    </div>

{{--        @if($category->content)--}}
{{--            <div class="row">--}}
{{--                <div class="col p-1">--}}
{{--                    <marquee style=" border:1px solid whitesmoke;font-size: 18px; color: #04B4F2; font-weight: bold;">{{$category->content}}</marquee>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

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
            @if($category->content2)
                <collapse-text :text="{{json_encode($category->content2)}}"></collapse-text>
            @endif
        </div>
@endsection
