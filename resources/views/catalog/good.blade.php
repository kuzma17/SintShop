@extends('layouts.page')

@section('link'){{Breadcrumbs::render('good', $good)}}@endsection
@section('body')
        <div class="good">
            <div class="row">
                <div class="col-12 col-md-6">
                    <photos-good
                        :patch="{{json_encode('/images/goods/')}}"
                        :photos="{{json_encode($good->photos)}}"
                        :no_photo="{{json_encode('no_photo.png')}}"
                    ></photos-good>
                </div>
                <div class="col-12 col-md-6">
                    <div class="good-set">
                        <div class="title">
                            <h4>{{$good->title}}</h4>
                        </div>
                        <div class="code">
                            <span class="title-sm">@lang('catalog.code_good'):</span> {{$good->code}}
                        </div>
                        <x-existence
                            :good=$good
                        ></x-existence>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <div class="price">
                                    {{$good->price}} грн.
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="button">
                                    <x-button-add-cart
                                        :good=$good
                                    ></x-button-add-cart>
                                </div>
                            </div>
                        </div>
                        <div class="delivery">
                           <div class="title-sm"><i class="fa-solid fa-truck-arrow-right"></i> @lang('catalog.delivery'):</div>
                            <ul>
                                <li>@lang('catalog.pickup')</li>
                                <li>@lang('catalog.delivery_address')</li>
                                <li><a href="">@lang('catalog.more')</a> </li>
                            </ul>
                        </div>
                        <div class="payment">
                            <div class="title-sm"><i class="fa-regular fa-money-bill-1"></i> @lang('catalog.payment'):</div>
                            <ul>
                                <li>@lang('catalog.cash')</li>
                                <li>@lang('catalog.cashless')</li>
                                <li>@lang('catalog.on_cart')</li>
                                <li><a href="">@lang('catalog.more')</a> </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="descriptions">
                <h4>@lang('catalog.description')</h4>
                {!! $good->description !!}
            </div>
        </div>
@endsection
