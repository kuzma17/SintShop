@extends('admin.layouts.app')

@section('content')
    <h4>Редактирование страницы</h4>
    <div class="good">
        <form name="page" method="post" enctype="multipart/form-data" action="{{route('admin.pages.update', $page->id)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$page->id}}">
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование ru
                </label>
                <div class="col-9">
                    <input type="text" name="name_ru" value="{{old('name_ru', $page->name_ru)}}" class="form-control @error('name_ru') is-invalid @enderror">
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
                    <input type="text" name="name_ua" value="{{old('name_ua', $page->name_ua)}}" class="form-control @error('name_ua') is-invalid @enderror">
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
                    <input type="text" name="title_ru" value="{{old('title_ru', $page->title_ru)}}" class="form-control @error('title_ru') is-invalid @enderror">
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
                    <input type="text" name="title_ua" value="{{old('title_ua', $page->title_ua)}}" class="form-control @error('title_ua') is-invalid @enderror">
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
                    <input type="text" name="keywords_ru" value="{{old('keywords_ru', $page->keywords_ru)}}" class="form-control @error('keywords_ru') is-invalid @enderror">
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
                    <input type="text" name="keywords_ua" value="{{old('keywords_ua', $page->keywords_ua)}}" class="form-control @error('keywords_ua') is-invalid @enderror">
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
                        {{old('description_ru', $page->description_ru)}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                   Description ua
                </label>
                <div class="col-9">
                    <textarea name="description_ua" class="form-control">
                        {{old('description_ru', $page->description_ua)}}
                    </textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Контент ru
                </label>
                <div class="col-9">
                    <quill-editor
                            name="content_ru"
                            :value="{{json_encode(old('content_ru', $page->content_ru))}}"
                            class="@error('content_ru') is-invalid @enderror"
                    ></quill-editor>
                    @error('content_ru')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Контент ua
                </label>
                <div class="col-9">
                    <quill-editor
                            name="content_ua"
                            :value="{{json_encode(old('content_ru', $page->content_ua))}}"
                            class="@error('content_ua') is-invalid @enderror"
                    ></quill-editor>
                    @error('content_ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>

            </div>

            <div class="row mb-3">
                <label class="col-2">
                    slug
                </label>
                <div class="col-9">
                    <input type="text" name="slug" value="{{old('slug', $page->slug)}}" class="form-control @error('slug') is-invalid @enderror">
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
                    <input name="active" class="form-check-input" type="checkbox" value="1" @checked($page->active)>
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
