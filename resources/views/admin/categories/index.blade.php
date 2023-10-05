@extends('admin.layouts.app')

@section('content')
    <h4>Категории</h4>
    <a style="float: right" href="{{route('admin.categories.create')}}"><button class="btn btn-success">Создать категорию</button></a>
    <div class="goods">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Наименование</th>
                <th scope="col">картинка</th>
                <th scope="col">сортировка</th>
                <th scope="col">статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title_ru}}</td>
                    <td>@if($category->image) <img src="/images/{{$category->image}}"> @endif</td>
                    <td>{{$category->sort}}</td>
                    <td>{{$category->active}}</td>
                    <td>
                        <a href="{{route('admin.categories.edit', $category->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
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
    </div>
@endsection