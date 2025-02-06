@extends('admin.layouts.app')

@section('content')
    <h4>Пользователи</h4>
    <a class="create_item" href="{{route('admin.users.create')}}"><button class="btn btn-success">Создать пользователя</button></a>
    <div class="goods">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Login</th>
                <th scope="col">type</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->login}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>
                        <a href="{{route('admin.users.edit', $user->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
{{--                        <form name="destroy_good" method="POST" style="margin: -30px 0 0 20px" action="{{route('admin.pages.destroy', $page->id)}}">--}}
{{--                            @method('DELETE')--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="btn btn-link" style="color: red" title="Удалить" onclick="return confirm('Вы уверены что хотите удалить объект?')">--}}
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
