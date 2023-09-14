@extends('user.app')

@section('sub_title')@lang('user.orders').@endsection

@section('user_content')

    <div class="user_orders">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">@lang('user.time_created')</th>
                <th scope="col">@lang('user.order_count')</th>
                <th scope="col">@lang('user.sum')</th>
                <th scope="col">@lang('user.status')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->count}}</td>
                    <td>{{$order->summa}} @lang('main.curr')</td>
                    <td>{{$order->status->title}}</td>
                    <td><a href="{{route('user.order', $order->id)}}" ><i class="fa-regular fa-eye"></i> @lang('user.see')</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>

            {!! $orders->links() !!}

    </div>

@endsection

