@extends('admin.layouts.app')

@section('content')
    <h4>Заказы</h4>
    <div class="goods">
        @include('admin.orders.filter')
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Клиент</th>
                <th scope="col">Сумма</th>
                <th scope="col">время создания</th>
                <th scope="col">статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->summa}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->status->title}}</td>
                    <td>
                        <a href="{{route('admin.orders.edit', $order->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $orders->links() !!}
    </div>
@endsection
