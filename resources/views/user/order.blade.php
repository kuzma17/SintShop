@extends('user.app')
@section('sub_title')@lang('user.order') № {{$order->id}}.@endsection
@section('user_content')

    <div class="user_orders">

        <div class="row">
            <div class="param">id:</div>
            <div class="col">{{$order->id}}</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.time_created'):</div>
            <div class="col">{{$order->created_at}}</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.order_count'):</div>
            <div class="col">{{$order->count}}</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.sum'):</div>
            <div class="col">{{$order->summa}} @lang('main.curr')</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.delivery'):</div>
            <div class="col">{!! $order->delivery->title !!}</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.delivery_address'):</div>
            <div class="col">{{$order->delivery_address}}</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.payment'):</div>
            <div class="col">{{$order->payment->title}}</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.status')</div>
            <div class="col">{{$order->status->title}}</div>
        </div>
        <div class="row">
            <div class="param">@lang('order.note'):</div>
            <div class="col">{{$order->note}}</div>
        </div>
        <div class="row">
            <div class="param">@lang('user.items'):</div>
            <div class="col"></div>
        </div>
        <div class="positions">
            <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">@lang('user.good_name')</th>
                <th scope="col">@lang('user.code')</th>
                <th scope="col">@lang('user.price')</th>
                <th scope="col">@lang('user.quantity')</th>
                <th scope="col">@lang('user.sum')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->goods as $good)
                <tr>
                    <td>{{$good->id}}</td>
                    <td><a href="{{route('good', [$good->slug, $good->id])}}"><img src="/images/goods/{{$good->photos->first()->src}}"> {{$good->title}}</a></td>
                    <td>{{$good->code}}</td>
                    <td>{{$good->pivot->price}} @lang('main.curr')</td>
                    <td>{{$good->pivot->quantity}} </td>
                    <td>{{$good->pivot->price * $good->pivot->quantity}} @lang('main.curr')</td>
                </tr>
            @endforeach

            </tbody>
            </table>
        </div>


    </div>

@endsection

