@extends('admin.layouts.app')

@section('content')
    <h4>Бренды</h4>
    <a class="create_item" href="{{route('admin.vendors.create')}}"><button class="btn btn-success">Создать бренд</button></a>
    <div class="goods">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Наименование</th>
{{--                <th scope="col">Logo</th>--}}
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($vendors as $vendor)
                <tr>
                    <td>{{$vendor->title}}</td>
{{--                    <td></td>--}}
                    <td>
                        <a href="{{route('admin.vendors.edit', $vendor->id)}}" title="редактировать"><i class="fa-regular fa-pen-to-square"></i></a>
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

        {!! $vendors->links() !!}

    </div>
@endsection
