@extends('admin.layouts.app')

@section('content')
    <h4>Заказы</h4>
    <div class="goods">
        @include('admin.orders.filter')
        <table class="table table-hover">
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
                <tr onclick="location.href='{{route('admin.orders.edit', $order->id)}}'">
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}} <i class="fa-solid fa-phone"></i> +38{{$order->user->phone}}</td>
                    <td>{{$order->summa}}</td>
                    <td>{{$order->created_at}}</td>
                    <td><x-admin.status
                            :status="$order->status"
                        ></x-admin.status></td>
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
