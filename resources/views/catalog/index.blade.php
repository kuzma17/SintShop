@extends('layouts.page')

@section('link' ,Breadcrumbs::render('catalog', $category))

@section('title', $category->title)
@section('name_page', $category->name)

@section('body')
        <div class="sort-panel">
            <x-sort></x-sort>
        </div>

        <x-sub-categories
                :category="$category"
        ></x-sub-categories>
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
        @if($category->content)
            <div class="content">
            {!! $category->content !!}
            </div>
        @endif


@endsection
