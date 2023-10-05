@extends('admin.layouts.app')

@section('content')
<h4>Товары</h4>
<a style="float: right" href="{{route('admin.goods.create')}}"><button class="btn btn-success">Создать товар</button></a>
<div class="goods">
    <div class="clearfix"></div>
    <div class="filter" style="padding: 10px 10px; margin: 10px 0;
    background-color: whitesmoke;
    border: 1px solid #CCCCCC; border-radius: 5px">
        <form name="filter" method="GET" action="{{route('admin.goods.index')}}">
        <div class="row">
            <div class="col-auto" >
                <i class="fa-solid fa-filter"></i> Фильтр
            </div>
            <div class="col-1">
                <input type="text" name="id" value="{{request('id')}}" class="form-control form-control-sm" placeholder="id">
            </div>
            <div class="col">
                <select name="category" class="form-control form-control-sm">
                    <option value="">Категория</option>
                    @php($categories = \App\Models\Category::all())
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @selected(request('category') == $category->id)>{{$category->title_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <input type="text" name="slug" value="{{request('slug')}}" class="form-control form-control-sm" placeholder="slug">
            </div>
            <div class="col-2">
                <input type="text" name="code" value="{{request('code')}}" class="form-control form-control-sm" placeholder="code">
            </div>
            <div class="col">
                <input type="text" name="title" value="{{request('title')}}" class="form-control form-control-sm" placeholder="Наименование">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-blue">Применить</button>
            </div>
            <div class="col-auto">
                <a href="{{route('admin.goods.index')}}">
                <span class="btn btn-sm btn-secondary">Reset</span>
                </a>
            </div>
        </div>
        </form>
    </div>
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
</div>
@endsection
