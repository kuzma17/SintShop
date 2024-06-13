@extends('layouts.page')

@section('title', __('seo.category_title', ['name' => $category->title]))
@section('keywords', __('seo.category_keywords', ['name' => $category->title]))
@section('description', __('seo.category_description', ['name' => $category->title]))

@section('link' ,Breadcrumbs::render('catalog', $category))
@section('name_page', $category->name)

@section('body')
        <div class="sort-panel">
            <x-sort></x-sort>
        </div>

        <x-sub-categories
                :category="$category"
        ></x-sub-categories>
        <div class="row">
{{--            <div class="col-2">--}}
{{--                <filter-goods--}}
{{--                        :attributess="{{json_encode($attributes)}}"--}}
{{--                ></filter-goods>--}}
{{--            </div>--}}
            <div class="col-12">
                <div class="catalog">
                    <div class="row justify-content-center">
                        @foreach($goods as $good)
                            <x-card-good
                                    :good=$good
                            ></x-card-good>
                        @endforeach
                    </div>
                    <div>
                        {{$goods->links()}}
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
