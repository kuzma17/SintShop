@extends('admin.layouts.app')

@section('content')
    <h4>Заказ №{{$order->id}}</h4>
    <div class="goods">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Наименование</th>
                <th scope="col">Артикул</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
                <th scope="col">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->goods as $good)
                <tr>
                    <td>
                        <a href="{{route('good', [$good->slug, $good->id])}}">
                            <img src="{{'/images/goods/'.$good->photos->first()->src}}"> {{$good->title_ru}}
                        </a>
                    </td>
                    <td>{{$good->code}}</td>
                    <td>{{$good->pivot->price}} @lang('main.curr')</td>
                    <td>{{$good->pivot->quantity}}</td>
                    <td>{{$good->pivot->price * $good->pivot->quantity}} @lang('main.curr')</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row mb-3">
            <label class="col-2 star">
                Сумма заказа
            </label>
            <div class="col-9">
                {{$order->summa}} @lang('main.curr')
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 star">
                Доставка
            </label>
            <div class="col-9">
                {{$order->delivery->title_ru}}
            </div>
        </div>
        @if($order->delivery_address)
            <div class="row mb-3">
                <label class="col-2 star">
                   Адрес доставки
                </label>
                <div class="col-9">
                    {{$order->delivery_address}}
                </div>
            </div>
        @endif
        <div class="row mb-3">
            <label class="col-2 star">
                Оплата
            </label>
            <div class="col-9">
                {{$order->payment->title_ru}}
            </div>
        </div>

    </div>

@endsection
