@extends('admin.layouts.app')

@section('content')
    <h4>Клиенты</h4>

    <div class="clients">
        <div class="clearfix"></div>
        @include('admin.clients.filter')
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Имя</th>
                <th scope="col">Телефон</th>
                <th scope="col">Время регистрации</th>
                <th scope="col">статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>+38{{$user->phone}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
{{--                        <x-admin.active--}}
{{--                            :status="$category->active"--}}
{{--                        ></x-admin.active>--}}
                    </td>
                    <td>
                        <a href="{{route('admin.orders.index', ['phone' => $user->phone])}}" title="Заказы все">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                        </a> &nbsp;
                        <a href="{{route('admin.orders.index', ['phone' => $user->phone, 'status' => 1])}}" title="Заказы в ожидании">
                            <i class="fa-solid fa-cart-arrow-down text-danger"></i>
                        </a> &nbsp;
                        <a href="{{route('admin.orders.index', ['phone' => $user->phone, 'status' => 2])}}" title="Заказы выполненные">
                            <i class="fa-solid fa-cart-arrow-down text-secondary"></i>
                        </a> &nbsp;

                        <a href="{{route('admin.clients.show', $user->id)}}"><i class="fa-regular fa-eye"></i></a>
{{--                        <a href="{{route('admin.categories.edit', $category->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>--}}
{{--                        <form name="destroy_good" method="POST" style="margin: -30px 0 0 10px" action="{{route('admin.categories.destroy', $category->id)}}">--}}
{{--                            @method('DELETE')--}}
{{--                            @csrf--}}
{{--                            <button onclick="alert(4234)" type="submit" class="btn btn-link" style="color: red" title="Удалить">--}}
{{--                                <i class="fa-regular fa-trash-can"></i>--}}
{{--                            </button>--}}
{{--                        </form>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $users->links() !!}

    </div>
@endsection
