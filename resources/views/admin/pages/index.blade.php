@extends('admin.layouts.app')

@section('content')
    <h4>Страницы</h4>
    <a class="create_item" href="{{route('admin.pages.create')}}"><button class="btn btn-success">Создать страницу</button></a>
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
            @foreach($pages as $page)
                <tr>
                    <td>
                        <a href="{{route('page', $page->slug)}}" title="просмотр на сайте"><i class="fa-regular fa-eye"></i></a> &nbsp;
                        <a href="{{route('admin.pages.edit', $page->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
                        {{--                        <form name="destroy_good" method="POST" style="margin: -30px 0 0 20px" action="{{route('admin.pages.destroy', $page->id)}}">--}}
                        {{--                            @method('DELETE')--}}
                        {{--                            @csrf--}}
                        {{--                            <button type="submit" class="btn btn-link" style="color: red" title="Удалить" onclick="return confirm('Вы уверены что хотите удалить объект?')">--}}
                        {{--                                <i class="fa-regular fa-trash-can"></i>--}}
                        {{--                            </button>--}}
                        {{--                        </form>--}}
                    </td>
                    <td>{{$page->slug}}</td>
                    <td>{{$page->name_ru}}</td>
                    <td>
                        <x-admin.active
                            :status="$page->active"
                        ></x-admin.active>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

{{--        {!! $pages->links() !!}--}}

    </div>
@endsection
