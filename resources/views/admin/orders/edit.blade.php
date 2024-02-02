@extends('admin.layouts.app')

@section('content')
    <h4>Заказ №{{$order->id}}</h4>
    <div class="orders">
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

        <form name="" method="POST" action="{{route('admin.orders.update', $order->id)}}">
            @method('PUT')
            @csrf
        <div class="row mb-3">
            <label class="col-2 star">
                Количество товаров
            </label>
            <div class="col-9">
                {{$order->count}}
            </div>
        </div>

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
                Время создания заказа
            </label>
            <div class="col-9">
                {{$order->created_at}}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-2 star">
                Клиент
            </label>
            <div class="col-9">
                <a href="{{route('admin.clients.show',$order->user->id)}}" title="Открыть карточку клиента">
                    {{$order->user->name}} <i class="fa-solid fa-phone"></i> +38{{$order->user->phone}}
                    @if($order->user->email) <i class="fa-regular fa-envelope"></i> {{$order->user->email}} @endif
                </a>
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
        @if($order->delivery->id == 2 && $order->delivery_address)
            <div class="row mb-3">
                <label class="col-2 star">
                   Адрес доставки
                </label>
                <div class="col-9">
                    {{$order->delivery_address}}
                </div>
            </div>
        @endif
            @if($order->delivery->id == 3)
                @if($order->np_city)
                <div class="row mb-3">
                    <label class="col-2 star">
                        Город, населенный пункт
                    </label>
                    <div class="col-9">
                        {{$order->np_city}}
                    </div>
                </div>
                @endif
                    @if($order->np_warehouse)
                        <div class="row mb-3">
                            <label class="col-2 star">
                                Отделение "Новой почты"
                            </label>
                            <div class="col-9">
                                {{$order->np_warehouse}}
                            </div>
                        </div>
                    @endif
            @endif
        <div class="row mb-3">
            <label class="col-2 star">
               Тип оплаты
            </label>
            <div class="col-9">
                {{$order->payment->title_ru}}
            </div>
        </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Коментарий
                </label>
                <div class="col-9">
                    {{$order->note}}
                </div>
            </div>
        <div class="row mb-3">
            <label class="col-2 star">
               Статус
            </label>
            <div class="col-3">
{{--                <x-admin.status--}}
{{--                    :status="$order->status"--}}
{{--                ></x-admin.status>--}}
{{--                <input type="hidden" name="status_id" value="2">--}}
                <select name="status_id" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{$status->id}}" @selected($status->id == $order->status_id)>{{$status->title_ru}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-2 star">

            </label>
            <div class="col-9">
                <button type="submit" class="btn btn-success" @disabled($order->status_id == 2)>Сохранить</button>
            </div>
        </div>

        </form>

    </div>

@endsection
