@extends('admin.layouts.app')

@section('content')
    <h4>Создание товара</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data" action="{{route('admin.goods.store')}}">
            @csrf
            <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main" type="button" role="tab" aria-controls="home" aria-selected="true">
                        <h6>Основные параметры</h6>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="attributes-tab" data-bs-toggle="tab" data-bs-target="#attributes" type="button" role="tab" aria-controls="profile" aria-selected="false">
                        <h6>Атрибуты</h6>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">
                        <h6>Видео</h6>
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
                    <category-good
                        :categories="{{json_encode($categories)}}"
                        :category="{{json_encode(old('category_id'))}}"
                    ></category-good>
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
{{--                    <textarea name="description_ru" class="form-control">--}}
{{--                        {{old('description_ru')}}--}}
{{--                    </textarea>--}}
                            <quill-editor
                                    name="description_ru"
                                    :value="{{json_encode(old('description_ru'))}}"
                            ></quill-editor>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            Описание ua
                        </label>
                        <div class="col-9">
{{--                    <textarea name="description_ua" class="form-control">--}}
{{--                        {{old('description_ru')}}--}}
{{--                    </textarea>--}}
                            <quill-editor
                                    name="description_ua"
                                    :value="{{json_encode(old('description_ua'))}}"
                            ></quill-editor>
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
                           Распродажа
                        </label>
                        <div class="col-2">
                            <input name="sale" type="hidden" value="0"/>
                            <input name="sale" class="form-check-input" type="checkbox" value="1" @checked(old('sale', false))/>
                            <span> &nbsp; &nbsp; <img src="/images/sale.png" class="sale_icon"></span>
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
                </div>
                <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="attributes-tab">
                    <attributes-good
                        :values-attribute="{{json_encode(old('values'))}}"
                    ></attributes-good>
                </div>
                <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                    <videos-good
                            :videos="{{json_encode(old('videos'))}}"
                    ></videos-good>
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
