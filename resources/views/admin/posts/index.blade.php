@extends('admin.layouts.app')

@section('content')
    <h4>Статьи</h4>
    <a class="create_item" href="{{route('admin.posts.create')}}" target="_blank"><button class="btn btn-success">Создать статью</button></a>
    <div class="goods">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th scope="col">slug</th>
                <th scope="col">Наименование</th>
                <th scope="col">статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        <a href="{{route('post', $post->slug)}}" target="_blank" title="просмотр на сайте"><i class="fa-regular fa-eye"></i></a> &nbsp;
                        <a href="{{route('admin.posts.edit', $post->id)}}" target="_blank" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
                        {{--                        <form name="destroy_good" method="POST" style="margin: -30px 0 0 20px" action="{{route('admin.posts.destroy', $post->id)}}">--}}
                        {{--                            @method('DELETE')--}}
                        {{--                            @csrf--}}
                        {{--                            <button type="submit" class="btn btn-link" style="color: red" title="Удалить" onclick="return confirm('Вы уверены что хотите удалить объект?')">--}}
                        {{--                                <i class="fa-regular fa-trash-can"></i>--}}
                        {{--                            </button>--}}
                        {{--                        </form>--}}
                    </td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->name_ru}}</td>
                    <td>
                        <x-admin.active
                            :status="$post->active"
                        ></x-admin.active>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

{{--        {!! $posts->links() !!}--}}

    </div>
@endsection
