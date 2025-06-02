@extends('admin.layouts.app')

@section('content')
    <h4>Создание Атрибута</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data" action="{{route('admin.attributes.store')}}">
            @csrf
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование ru
                </label>
                <div class="col-9">
                    <input type="text" name="name_ru" value="{{old('name_ru')}}" class="form-control @error('name_ru') is-invalid @enderror">
                    @error('name_ru')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование ua
                </label>
                <div class="col-9">
                    <input type="text" name="name_ua" value="{{old('name_ua')}}" class="form-control @error('name_ua') is-invalid @enderror">
                    @error('name_ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Категория
                </label>
                <div class="col-9">
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"  @selected($category->id == old('category_id'))>{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    slug
                </label>
                <div class="col-9">
                    <input type="text" name="slug" value="{{old('slug')}}" class="form-control @error('slug') is-invalid @enderror">
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <type-attribute
                model-value="{{old('type_id')}}"
                :types-attribute="{{json_encode($types)}}"
                :values-attribute="{{json_encode(old('values'))}}"
            ></type-attribute>

            <div class="row mb-3">
                <label class="col-2 star">
                    Сортировка
                </label>
                <div class="col-9">
                    <input type="text" name="sort" value="{{old('sort', 1)}}" class="form-control @error('sort') is-invalid @enderror">
                    @error('sort')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                   Показывать в фильтре
                </label>
                <div class="col-9">
                    <input name="filter" class="form-check-input" type="checkbox" value="0" @checked(old('filter', false))/>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Статус
                </label>
                <div class="col-9">
                    <input name="active" class="form-check-input" type="checkbox" value="1" @checked(old('active', true))/>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                </label>
                <div class="col-9">
                    <button type="submit" class="btn btn-blue">Сохранить</button>
                </div>
            </div>
        </form>

    </div>

@endsection
