@extends('layouts.page')

@section('link', Breadcrumbs::render('search'))

@section('title', __('main.searching_results').' '.$q)
@section('body')

{{--        <div class="sort-panel">--}}
{{--            <x-sort></x-sort>--}}
{{--            <sort-goods></sort-goods>--}}
{{--        </div>--}}
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
