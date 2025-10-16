@extends('admin.layouts.app')

@section('content')
    <h4>Редактирование статьи</h4>
    <div class="good">
        <form name="post" method="post" enctype="multipart/form-data" action="{{route('admin.posts.update', $post->id)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$post->id}}">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="page-tab" data-bs-toggle="tab" data-bs-target="#page" type="button" role="tab">
                        page
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab">
                        SEO
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="page" role="tabpanel">
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
                </div>
                <div class="tab-pane fade" id="seo" role="tabpanel">
                    <div class="row mb-3">
                        <label class="col-2">
                            Title ru
                        </label>
                        <div class="col-9">
                            <input type="text" name="seo[meta_title_ru]" value="{{old('seo.meta_title_ru', $post->seo?->meta_title_ru)}}" class="form-control @error('meta_title_ru') is-invalid @enderror">
                            @error('seo.meta_title_ru')
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
                            <input type="text" name="seo[meta_title_ua]" value="{{old('seo.meta_title_ua', $post->seo?->meta_title_ua)}}" class="form-control @error('meta_title_ua') is-invalid @enderror">
                            @error('seo.meta_title_ua')
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
                    <textarea name="seo[meta_description_ru]" class="form-control">
                        {{old('seo.meta_description_ru', $post->seo?->meta_description_ru)}}
                    </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            Description ua
                        </label>
                        <div class="col-9">
                    <textarea name="seo[meta_description_ua]" class="form-control">
                        {{old('seo.meta_description_ru', $post->seo?->meta_description_ua)}}
                    </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-2">
                            Keywords ru
                        </label>
                        <div class="col-9">
                            <input type="text" name="seo[meta_keywords_ru]" value="{{old('meta_keywords_ru', $post->seo?->meta_keywords_ru)}}" class="form-control @error('meta_keywords_ru') is-invalid @enderror">
                            @error('seo.meta_keywords_ru')
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
                            <input type="text" name="seo[meta_keywords_ua]" value="{{old('meta_keywords_ua', $post->seo?->meta_keywords_ua)}}" class="form-control @error('meta_keywords_ua') is-invalid @enderror">
                            @error('seo.meta_keywords_ua')
                            <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-2">
                            og Title ru
                        </label>
                        <div class="col-9">
                            <input type="text" name="seo[og_title_ru]" value="{{old('og_title_ru', $post->seo?->og_title_ru)}}" class="form-control @error('og_title_ru') is-invalid @enderror">
                            @error('seo.og.title_ru')
                            <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            og Title ua
                        </label>
                        <div class="col-9">
                            <input type="text" name="seo[og_title_ua]" value="{{old('og_title_ua', $post->seo?->og_title_ru)}}" class="form-control @error('og_title_ua') is-invalid @enderror">
                            @error('seo.og.title_ua')
                            <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-2">
                            og Description ru
                        </label>
                        <div class="col-9">
                    <textarea name="seo[og_description_ru]" class="form-control">
                        {{old('seo.description_ru', $post->seo?->og_description_ru)}}
                    </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            og Description ua
                        </label>
                        <div class="col-9">
                    <textarea name="seo[og_description_ua]" class="form-control">
                        {{old('seo.description_ru', $post->seo?->og_description_ua)}}
                    </textarea>
                        </div>
                    </div>

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
