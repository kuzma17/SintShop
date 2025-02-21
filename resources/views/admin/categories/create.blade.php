@extends('admin.layouts.app')

@section('content')
    <h4>Создание Категории</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data" action="{{route('admin.categories.store')}}">
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
                <label class="col-2">
                    Родительская категория
                </label>
                <div class="col-9">
                    <select name="parent_id" class="form-control">
                        <option value=""> - root - </option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}" @selected($item->id == old('parent_id'))>{{$item->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Title ru
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
                <label class="col-2">
                    Title ua
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
                <label class="col-2">
                    Keywords ru
                </label>
                <div class="col-9">
                    <input type="text" name="keywords_ru" value="{{old('keywords_ru')}}" class="form-control @error('keywords_ru') is-invalid @enderror">
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
                    <input type="text" name="keywords_ua" value="{{old('keywords_ua')}}" class="form-control @error('keywords_ua') is-invalid @enderror">
                    @error('keywords_ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Description ru
                </label>
                <div class="col-9">
                    <textarea name="description_ru" class="form-control">
                        {{old('description_ru')}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Description ua
                </label>
                <div class="col-9">
                    <textarea name="description_ua" class="form-control">
                        {{old('description_ru')}}
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
                    ></input-image>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Контент ru
                </label>
                <div class="col-9">
                    <text-editor
                            name="content_ru"
                            value="{{old('content_ru')}}"
                            apikey="{{env('TINYMCE_KEY')}}"
                    ></text-editor>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Контент ua
                </label>
                <div class="col-9">
                    <text-editor
                            name="content_ua"
                            value="{{old('content_ua')}}"
                            apikey="{{env('TINYMCE_KEY')}}"
                    ></text-editor>
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
                    Сортировка
                </label>
                <div class="col-9">
                    <input type="text" name="sort" value="{{old('sort')}}" class="form-control @error('sort') is-invalid @enderror">
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
