@extends('admin.layouts.app')

@section('content')
    <h4>Редактирование товара</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data"
              action="{{route('admin.goods.update', $good->id)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$good->id}}">
            <input type="hidden" name="prev_category_id" value="{{$good->category_id}}">
            <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main"
                            type="button" role="tab" aria-controls="home" aria-selected="true">
                        <h6>Основные параметры</h6>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="attributes-tab" data-bs-toggle="tab" data-bs-target="#attributes"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">
                        <h6>Атрибуты</h6>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                    <div class="row mb-3">
                        <label class="col-2 star">
                            Наименование ru
                        </label>
                        <div class="col-9">
                            <input type="text" name="title_ru" value="{{old('title_ru', $good->title_ru)}}"
                                   class="form-control @error('title_ru') is-invalid @enderror">
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
                            <input type="text" name="title_ua" value="{{old('title_ua', $good->title_ua)}}"
                                   class="form-control @error('title_ua') is-invalid @enderror">
                            @error('title_ua')
                            <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                            @enderror
                        </div>
                    </div>
                    <category-good
                        :categories="{{json_encode($categories)}}"
                        :category="{{json_encode(old('category_id', $good->category_id))}}"
                    ></category-good>
                    <div class="row mb-3">
                        <label class="col-2 star">
                            Бренд
                        </label>
                        <div class="col-9">
                            <select name="vendor_id" class="form-control">
                                @foreach($vendors as $vendor)
                                    <option
                                        value="{{$vendor->id}}" @selected($vendor->id == old('vendor_id', $good->vendor_id))>{{$vendor->title}}</option>
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
                        {{old('description_ru', $good->description_ru)}}
                    </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            Описание ua
                        </label>
                        <div class="col-9">
                    <textarea name="description_ua" class="form-control">
                        {{old('description_ru', $good->description_ua)}}
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
                                :model-value="{{json_encode(old('images', $good->photos))}}"
                            ></input-photos>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-2 star">
                            slug
                        </label>
                        <div class="col-9">
                            <input type="text" name="slug" value="{{old('slug', $good->slug)}}"
                                   class="form-control @error('slug') is-invalid @enderror">
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
                            <input type="text" name="code" value="{{old('code', $good->code)}}"
                                   class="form-control @error('code') is-invalid @enderror">
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
                            <input type="text" name="quantity" value="{{old('quantity', $good->quantity)}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 star">
                            Цена
                        </label>
                        <div class="col-9">
                            <input type="text" name="price" value="{{old('price', $good->price)}}"
                                   class="form-control @error('price') is-invalid @enderror">
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
                            <input name="active" class="form-check-input" type="checkbox"
                                   value="1" @checked($good->active)>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="attributes-tab">
                    <attributes-good
                        :attributes="{{json_encode($attributes)}}"
                        :values-attribute="{{json_encode(old('values', $values))}}"
                    ></attributes-good>
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
