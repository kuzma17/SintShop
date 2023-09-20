@extends('layouts.page')

@section('link' ,Breadcrumbs::render('catalog', $category))

@section('title', $category->title)

@section('body')
        <div class="sort-panel">
            <x-sort></x-sort>
        </div>
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


@endsection
