@extends('admin.layouts.app')

@section('content')
<h4>Товары</h4>
<a class="create_item" href="{{route('admin.goods.create')}}"><button class="btn btn-success">Создать товар</button></a>
<div class="goods">
    <div class="clearfix"></div>
    @include('admin.goods.filter')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Наименование</th>
            <th scope="col">Категория</th>
            <th scope="col">количество</th>
            <th scope="col">Цена</th>
            <th scope="col">статус</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($goods as $good)
        <tr>
            <td>{{$good->id}}</td>
            <td>@if($good->photos->count() > 0)
                    <img src="/images/goods/{{$good->photos->first()->src}}">
                @else
                    <img src="/images/goods/no_photo.png">
                @endif {{$good->title}} </td>
            <td>{{$good->category->title_ru}}</td>
            <td>{{$good->quantity}}</td>
            <td>{{$good->price}}</td>
            <td>{{$good->active}}</td>
            <td>
                <a href="{{route('admin.goods.edit', $good->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
                <form name="destroy_good" method="POST" style="margin: -30px 0 0 15px" action="{{route('admin.goods.destroy', $good->id)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-link" style="color: red" title="Удалить">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $goods->links() !!}

</div>
@endsection
