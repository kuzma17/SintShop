@extends('layouts.page')

@section('title', __('seo.category_title', ['name' => $category->title]))
@section('keywords', __('seo.category_keywords', ['name' => $category->title]))
@section('description', __('seo.category_description', ['name' => $category->title]))

@section('link' ,Breadcrumbs::render('catalog', $category))
@section('name_page', $category->name)

@section('body')
        <div class="sort-panel">
{{--            <x-sort></x-sort>--}}
            <sort-goods></sort-goods>
        </div>

        <x-sub-categories
                :category="$category"
        ></x-sub-categories>

        <div class="row">
            <div class="col-2 p-1">
                <x-filter
                        :category="$category"
                        :minPrice="$minPrice"
                        :maxPrice="$maxPrice"
                ></x-filter>
            </div>
            <div class="col-10 p1">
                <div class="catalog">
                    <div id="catalog" class="row justify-content-center">
                       @include('catalog.list', ['goods' => $goods])
                    </div>
                </div>
            </div>
        </div>
        @if($category->content)
            <div class="content">
            {!! $category->content !!}
            </div>
        @endif


@endsection
