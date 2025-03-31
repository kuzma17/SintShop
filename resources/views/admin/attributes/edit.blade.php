@extends('admin.layouts.app')

@section('content')
    <h4>Редактирование атрибута</h4>
    <div class="good">
        <form name="category" method="post" enctype="multipart/form-data" action="{{route('admin.attributes.update', $attribute->id)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$attribute->id}}">
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование ru
                </label>
                <div class="col-9">
                    <input type="text" name="name_ru" value="{{old('name_ru',  $attribute->name_ru)}}" class="form-control @error('name_ru') is-invalid @enderror">
                    @error('title_ru')
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
                    <input type="text" name="name_ua" value="{{old('name_ua', $attribute->name_ua)}}" class="form-control @error('name_ua') is-invalid @enderror">
                    @error('title_ua')
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
                            <option value="{{$category->id}}"  @selected($category->id == old('category_id', $attribute->category->id))>{{$category->title_ru}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
                    slug
                </label>
                <div class="col-9">
                    <input type="text" name="slug" value="{{old('slug', $attribute->slug)}}" class="form-control @error('slug') is-invalid @enderror">
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <type-attribute
                model-value="{{old('type_id', $attribute->type_id)}}"
                :types-attribute="{{json_encode($types)}}"
                :values-attribute="{{json_encode(old('values', $attribute->values))}}"
            ></type-attribute>

            <div class="row mb-3">
                <label class="col-2 star">
                    Сортировка
                </label>
                <div class="col-9">
                    <input type="text" name="sort" value="{{old('sort', $attribute->sort)}}" class="form-control @error('sort') is-invalid @enderror">
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
                    <input type="hidden" name="filter" value="0">
                    <input name="filter" class="form-check-input" type="checkbox" value="1" @checked(old('filter', $attribute->filter))/>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Статус
                </label>
                <div class="col-9">
                    <input name="active" class="form-check-input" type="checkbox" value="1" @checked(old('active', $attribute->active))/>
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
