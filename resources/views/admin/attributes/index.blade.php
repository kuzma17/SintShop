@extends('admin.layouts.app')

@section('content')
    <h4>Аттрибуты</h4>
    <a class="create_item" href="{{route('admin.attributes.create')}}"><button class="btn btn-success">Создать атрибут</button></a>
    <div class="clients">
        <div class="clearfix"></div>
        @include('admin.attributes.filter')
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Категория</th>
                <th scope="col">Имя</th>
                <th scope="col">Тип</th>
                <th scope="col">статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td>{{$attribute->id}}</td>
                    <td>{{$attribute->category->title}}</td>
                    <td>{{$attribute->name}}</td>
                    <td><span class="badge bg-secondary">{{$attribute->type->title}}</span></td>
                    <td>
                        <x-admin.active
                            :status="$attribute->active"
                        ></x-admin.active>
                    </td>
                   <td> <a href="{{route('admin.attributes.edit', $attribute->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
                       <form name="destroy_attribute" method="POST" style="margin: -30px 0 0 20px" action="{{route('admin.attributes.destroy', $attribute->id)}}">
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

        {!! $attributes->appends(request()->input())->links() !!}

    </div>
@endsection
