@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="link">
            {{ Breadcrumbs::render('search') }}
        </div>

        <h4>Результаты поиска: {{$q}}</h4>

        <div class="sort-panel">
            <x-sort
                category='sort'
            ></x-sort>
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
    </div>

@endsection
