@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="link">
            {{ Breadcrumbs::render('catalog', $category) }}
        </div>

        <h4>{{$category->title}}</h4>

        <div class="catalog">
            <div class="row justify-content-center">
                @foreach($goods as $good)
                    <div class="col-3 p-0">
                        <div class="good-cart">
                           <a href="{{route('good', [$good->slug, $good->id])}}">
                               <div class="photo">
                                   <img src="/images/goods/{{$good->photos->first()->src}}">
                               </div>
                               <div class="title">
                                   {{$good->title}}
                               </div>
                           </a>
                            <div class="row">
                                <div class="col-6">
                                    <div class="price">
                                        {{$good->price}} грн.
                                    </div>
                                </div>
                                <div class="col-6">
                                    <x-button-add-cart
                                        :good=$good
                                    ></x-button-add-cart>
                                </div>
                            </div>
                            <x-existence
                                :good=$good
                            ></x-existence>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                {{$goods->links()}}
            </div>
        </div>
    </div>

@endsection
