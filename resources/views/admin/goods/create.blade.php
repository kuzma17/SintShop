@extends('admin.layouts.app')

@section('content')
    <h4>Создание товара</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data" action="{{route('admin.goods.store')}}">
            @csrf
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование ru
                </label>
                <div class="col-9">
                    <input type="text" name="title_ru" value="{{old('title_ru')}}" class="form-control @error('title_ru') is-invalid @enderror">
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
                    <input type="text" name="title_ua" value="{{old('title_ua')}}" class="form-control @error('title_ua') is-invalid @enderror">
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
                            <option value="{{$category->id}}"  @selected($category->id == old('category_id'))>{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Бренд
                </label>
                <div class="col-9">
                    <select name="vendor_id" class="form-control">
                        @foreach($vendors as $vendor)
                            <option value="{{$vendor->id}}"  @selected($vendor->id == old('vendor_id'))>{{$vendor->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Описание ru
                </label>
                <div class="col-9">
                    <textarea name="description_ru" class="form-control">
                        {{old('description_ru')}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Описание ua
                </label>
                <div class="col-9">
                    <textarea name="description_ua" class="form-control">
                        {{old('description_ru')}}
                    </textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Фото
                </label>
                <div class="col-9">
                    <input-photos
                        :max_count_file="5"
                        path="{{env('GOOD_PHOTO_PATH')}}"
                        :model-value="{{json_encode(old('images'))}}"
                    ></input-photos>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
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
            <div class="row mb-3">
                <label class="col-2 star">
                    code
                </label>
                <div class="col-9">
                    <input type="text" name="code" value="{{old('code')}}" class="form-control @error('code') is-invalid @enderror">
                    @error('code')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Количество
                </label>
                <div class="col-9">
                    <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Цена
                </label>
                <div class="col-9">
                    <input type="text" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
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
