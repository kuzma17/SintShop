@extends('admin.layouts.app')

@section('content')
    <h4>Редактирование категории</h4>
    <div class="good">
        <form name="category" method="post" enctype="multipart/form-data" action="{{route('admin.categories.update', $category->id)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$category->id}}">
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование ru
                </label>
                <div class="col-9">
                    <input type="text" name="title_ru" value="{{old('title_ru', $category->title_ru)}}" class="form-control @error('title_ru') is-invalid @enderror">
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
                    <input type="text" name="title_ua" value="{{old('title_ua', $category->title_ua)}}" class="form-control @error('title_ua') is-invalid @enderror">
                    @error('title_ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Keywords ru
                </label>
                <div class="col-9">
                    <input type="text" name="keywords_ru" value="{{old('keywords_ru', $category->keywords_ru)}}" class="form-control @error('keywords_ru') is-invalid @enderror">
                    @error('keywords_ru')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                   Keywords ua
                </label>
                <div class="col-9">
                    <input type="text" name="keywords_ua" value="{{old('keywords_ua', $category->keywords_ua)}}" class="form-control @error('keywords_ua') is-invalid @enderror">
                    @error('keywords_ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Описание ru
                </label>
                <div class="col-9">
                    <textarea name="description_ru" class="form-control">
                        {{old('description_ru', $category->description_ru)}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Описание ua
                </label>
                <div class="col-9">
                    <textarea name="description_ua" class="form-control">
                        {{old('description_ru', $category->description_ua)}}
                    </textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Картинка
                </label>
                <div class="col-9">
                    <input-image
                        path="/images"
                        :model-value="{{json_encode(old('images', $category->image))}}"
                    ></input-image>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Контент ru
                </label>
                <div class="col-9">
                    <textarea name="content_ru" class="form-control">
                        {{old('content_ru', $category->content_ru)}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Контент ua
                </label>
                <div class="col-9">
                    <textarea name="content_ua" class="form-control">
                        {{old('content_ru', $category->content_ua)}}
                    </textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
                    slug
                </label>
                <div class="col-9">
                    <input type="text" name="slug" value="{{old('slug', $category->slug)}}" class="form-control @error('slug') is-invalid @enderror">
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Сортировка
                </label>
                <div class="col-9">
                    <input type="text" name="sort" value="{{old('sort', $category->sort)}}" class="form-control @error('sort') is-invalid @enderror">
                    @error('sort')
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
                    <input name="active" class="form-check-input" type="checkbox" value="1" @checked($category->active)>
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