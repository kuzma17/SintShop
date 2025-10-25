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
            <th scope="col">наименование</th>
            <th scope="col">категория</th>
            <th scope="col">количество</th>
            <th scope="col">распродажа</th>
            <th scope="col">Цена</th>
            <th scope="col">статус</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($goods as $good)
        <tr>
            <td>{{$good->id}}</td>
            <td>
                @if($good->photo)
                    <img src="/images/goods/small_{{$good->photo->src}}">
                @else
                    <img src="/images/no_photo.jpg">
                @endif {{$good->title}}
            </td>
            <td>{{$good->category->name}}</td>
            <td>{{$good->quantity}}</td>
            <td>@if($good->sale) <span class="badge rounded-pill text-bg-danger">sale</span> @endif</td>
            <td>{{$good->price}}</td>
            <td>
                <x-admin.active
                    :status="$good->active"
                ></x-admin.active>
            </td>
            <td>
                <a href="{{route('admin.goods.edit', $good->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
                <form name="destroy_good" method="POST" style="margin: -30px 0 0 20px" action="{{route('admin.goods.destroy', $good->id)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-link" style="color: red" title="Удалить" onclick="return confirm('Вы уверены что хотите удалить объект?')">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $goods->appends(request()->input())->links() !!}

</div>
@endsection
