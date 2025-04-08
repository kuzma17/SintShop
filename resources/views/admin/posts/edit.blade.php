@extends('admin.layouts.app')

@section('content')
    <h4>Редактирование статьи</h4>
    <div class="good">
        <form name="post" method="post" enctype="multipart/form-data" action="{{route('admin.posts.update', $post->id)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$post->id}}">
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование ru
                </label>
                <div class="col-9">
                    <input type="text" name="name_ru" value="{{old('name_ru', $post->name_ru)}}" class="form-control @error('name_ru') is-invalid @enderror">
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
                    <input type="text" name="name_ua" value="{{old('name_ua', $post->name_ua)}}" class="form-control @error('name_ua') is-invalid @enderror">
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
                    <input type="text" name="title_ru" value="{{old('title_ru', $post->title_ru)}}" class="form-control @error('title_ru') is-invalid @enderror">
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
                    <input type="text" name="title_ua" value="{{old('title_ua', $post->title_ua)}}" class="form-control @error('title_ua') is-invalid @enderror">
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
                    <input type="text" name="keywords_ru" value="{{old('keywords_ru', $post->keywords_ru)}}" class="form-control @error('keywords_ru') is-invalid @enderror">
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
                    <input type="text" name="keywords_ua" value="{{old('keywords_ua', $post->keywords_ua)}}" class="form-control @error('keywords_ua') is-invalid @enderror">
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
                        {{old('description_ru', $post->description_ru)}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                   Description ua
                </label>
                <div class="col-9">
                    <textarea name="description_ua" class="form-control">
                        {{old('description_ru', $post->description_ua)}}
                    </textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
                    Контент ru
                </label>
                <div class="col-9">
                    <quill-editor
                            name="content_ru"
                            :value="{{json_encode(old('content_ru', $post->content_ru))}}"
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
                <label class="col-2 star">
                    Контент ua
                </label>
                <div class="col-9">
{{--                    <text-editor--}}
{{--                            name="content_ua"--}}
{{--                            value="{{old('content_ua', $post->content_ua)}}"--}}
{{--                            apikey="{{env('TINYMCE_KEY')}}"--}}
{{--                    ></text-editor>--}}
                    <quill-editor
                            name="content_ua"
                            :value="{{json_encode(old('content_ru', $post->content_ua))}}"
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
                    Картинка
                </label>
                <div class="col-9">
                    <input-image
                            path="/images/posts"
                            :model-value="{{json_encode(old('images', $post->image))}}"
                    ></input-image>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Добавить callback
                </label>
                <div class="col-9">
                    <input type="hidden" name="callback" value="0">
                    <input name="callback" class="form-check-input" type="checkbox" value="1" @checked($post->callback)>
                </div>
            </div>
{{--            <div class="row mb-3">--}}
{{--                <label class="col-2 star">--}}
{{--                    Контент2 ru--}}
{{--                </label>--}}
{{--                <div class="col-9">--}}
{{--                    <text-editor--}}
{{--                            name="content2_ru"--}}
{{--                            value="{{old('content2_ru', $post->content2_ru)}}"--}}
{{--                            apikey="{{env('TINYMCE_KEY')}}"--}}
{{--                    ></text-editor>--}}
{{--                    @error('content2_ru')--}}
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
{{--                            value="{{old('content2_ua', $post->content2_ua)}}"--}}
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
                    <input type="text" name="slug" value="{{old('slug', $post->slug)}}" class="form-control @error('slug') is-invalid @enderror">
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
                    <input name="active" class="form-check-input" type="checkbox" value="1" @checked($post->active)>
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
