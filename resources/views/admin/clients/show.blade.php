@extends('admin.layouts.app')

@section('content')
    <h4>Клиент</h4>
    <div class="good">
        <table class="table table-striped table-clients">
            <tr>
                <th>Имя</th><td>{{$user->name}}</td>
            </tr>
            <tr>
                <th>Телефон</th><td>+38{{$user->phone}}</td>
            </tr>
            <tr>
                <th>E-mail</th><td>{{$user->email}}</td>
            </tr>
            <tr>
                <th>Тип оплаты</th><td>{{$user->payment->title_ru}}</td>
            </tr>
            <tr>
                <th>Доставка</th><td>{{$user->delivery->title_ru}}</td>
            </tr>
            <tr>
                <th>Адрес доставки</th><td>{{$user->delivery_address}}</td>
            </tr>
        </table>

    </div>


@endsection
