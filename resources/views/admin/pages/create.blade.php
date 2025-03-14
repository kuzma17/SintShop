@extends('admin.layouts.app')

@section('content')
    <h4>Создание Страницы</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data" action="{{route('admin.pages.store')}}">
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
                <label class="col-2 star">
                    Контент ru
                </label>
                <div class="col-9">
                    <text-editor
                            name="content_ru"
                            value="{{old('content_ru')}}"
                            apikey="{{env('TINYMCE_KEY')}}"
                    ></text-editor>
                    @error('content_ru')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Контент ua
                </label>
                <div class="col-9">
                    <text-editor
                            name="content_ua"
                            value="{{old('content_ua')}}"
                            apikey="{{env('TINYMCE_KEY')}}"
                    ></text-editor>
                    @error('content_ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
{{--            <div class="row mb-3">--}}
{{--                <label class="col-2 star">--}}
{{--                    Контент2 ru--}}
{{--                </label>--}}
{{--                <div class="col-9">--}}
{{--                    <text-editor--}}
{{--                            name="content2_ru"--}}
{{--                            value="{{old('content2_ru')}}"--}}
{{--                            apikey="{{env('TINYMCE_KEY')}}"--}}
{{--                    ></text-editor>--}}
{{--                    @error('content_ru')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                       <strong>{{ $message }}</strong>--}}
{{--                   </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mb-3">--}}
{{--                <label class="col-2 star">--}}
{{--                    Контент2 ua--}}
{{--                </label>--}}
{{--                <div class="col-9">--}}
{{--                    <text-editor--}}
{{--                            name="content2_ua"--}}
{{--                            value="{{old('content2_ua')}}"--}}
{{--                            apikey="{{env('TINYMCE_KEY')}}"--}}
{{--                    ></text-editor>--}}
{{--                    @error('content2_ua')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                       <strong>{{ $message }}</strong>--}}
{{--                   </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}

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
