@extends('layouts.page')

@section('body')
        <div class="order-created">
            <h4>@lang('order.thank_for_order')</h4>
            <div class="row row-param">
                <div class="col-2 parameter">@lang('order.number_order')</div> <div class="col value">{{$order->id}}</div>
            </div>
{{--            <div class="row row-param">--}}
{{--                <div class="parameter">Скачать накладную</div> <div class="value"><a href="{{route('export.order.xls', $order->id)}}"><i class="fa fa-download" aria-hidden="true"></i></a></div>--}}
{{--            </div>--}}
            <div class="clearfix"></div>
            <div class="row">
                <div class="parameter">@lang('order.count_good')</div> <div class="col value">{{$order->count}}</div>
            </div>
            <div class="row">
                <div class="parameter">@lang('order.cart_sum')</div> <div class=" col value text-orange">{{$order->summa}}</div>
            </div>
            <div class="row">
                <div class="parameter">@lang('order.delivery')</div> <div class="col value">{{$order->delivery->title}}</div>
            </div>
            @if($order->delivery_id == 2 && $order->delivery_address)
                <div class="row">
                    <div class="parameter">@lang('order.delivery_address')</div> <div class="col value">{{$order->delivery_address}}</div>
                </div>
            @endif
            @if($order->delivery_id == 3)
                @if($order->np_city)
                <div class="row">
                    <div class="parameter">@lang('order.np_city')</div> <div class="col value">{{$order->np_city}}</div>
                </div>
                @endif
                @if($order->np_warehouse)
                        <div class="row">
                            <div class="parameter">@lang('order.np_warehouse')</div> <div class="col value">{{$order->np_warehouse}}</div>
                        </div>
                @endif
            @endif
            <div class="row">
                <div class="parameter">@lang('order.payment')</div> <div class="col value">{{$order->payment->title}}</div>
            </div>

            <div class="information">
                @lang('order.order_created_info').
            </div>
            <div class="button_next">
                <a class="no_link" href="{{route('home')}}"><button class="btn btn-blue">@lang('order.continue_shopping')</button></a>
            </div>

        </div>
@endsection
