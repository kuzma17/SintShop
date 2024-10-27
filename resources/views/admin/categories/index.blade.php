@extends('admin.layouts.app')

@section('content')
    <h4>Категории</h4>
    <a class="create_item" href="{{route('admin.categories.create')}}"><button class="btn btn-success">Создать категорию</button></a>
    <div class="goods">

            <div class="row cat_head-table">
                <div class="col-1">id</div>
                <div class="col">Наименование</div>
                <div class="col">картинка</div>
                <div class="col">сортировка</div>
                <div class="col">статус</div>
                <div class="col"></div>
            </div>

        @include('admin.categories.sub_categories', ['categories' => $categories, 'margin_left' => 0])

    </div>
@endsection
