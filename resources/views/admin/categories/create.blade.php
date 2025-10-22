@extends('admin.layouts.app')

@section('content')
    <h4>Создание Категории</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data" action="{{route('admin.categories.store')}}">
            @csrf

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
                            <quill-editor
                                    name="content_ru"
                                    :value="{{json_encode(old('content_ru'))}}"
                            ></quill-editor>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            Контент ua
                        </label>
                        <div class="col-9">
                            <quill-editor
                                    name="content_ua"
                                    :value="{{json_encode(old('content_ua'))}}"
                            ></quill-editor>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-2">
                            Контент2 ru
                        </label>
                        <div class="col-9">
                            <quill-editor
                                    name="content2_ru"
                                    :value="{{json_encode(old('content2_ru'))}}"
                            ></quill-editor>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            Контент2 ua
                        </label>
                        <div class="col-9">
                            <quill-editor
                                    name="content2_ua"
                                    :value="{{json_encode(old('content2_ua'))}}"
                            ></quill-editor>
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
                        <label class="col-2 ">
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
                </div>
                <div class="tab-pane fade" id="seo" role="tabpanel">

                    <div class="row mb-3">
                        <label class="col-2">
                            Title ua
                        </label>
                        <div class="col-9">
                            <input type="text" name="seo[meta_title_ru]" value="{{old('seo.meta_title_ru')}}" class="form-control @error('seo.meta_title_ru') is-invalid @enderror">
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
                            <input type="text" name="seo[meta_title_ua]" value="{{old('seo.meta_title_ua')}}" class="form-control @error('seo.meta_title_ua') is-invalid @enderror">
                            @error('seo.meta_title_ua')
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
                            <input type="text" name="seo[meta_keywords_ru]" value="{{old('seo.meta_keywords_ru')}}" class="form-control @error('seo.meta_keywords_ru') is-invalid @enderror">
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
                            <input type="text" name="seo[meta_keywords_ua]" value="{{old('seo.meta_keywords_ua')}}" class="form-control @error('seo.meta_keywords_ua') is-invalid @enderror">
                            @error('seo.meta_keywords_ua')
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
                        {{old('seo.meta_description_ru')}}
                    </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            Description ua
                        </label>
                        <div class="col-9">
                    <textarea name="seo[meta_description_ua]" class="form-control">
                        {{old('seo.meta_description_ru')}}
                    </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-2">
                            og Title ru
                        </label>
                        <div class="col-9">
                            <input type="text" name="seo[og_title_ru]" value="{{old('seo.og_title_ru')}}" class="form-control @error('seo.og_title_ru') is-invalid @enderror">
                            @error('seo.og_title_ru')
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
                            <input type="text" name="seo[og_title_ua]" value="{{old('seo.og_title_ua')}}" class="form-control
                            @error('seo.og_title_ua') is-invalid @enderror">
                            @error('seo.og_title_ua')
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
                        {{old('seo.og_description_ru')}}
                    </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2">
                            og Description ua
                        </label>
                        <div class="col-9">
                    <textarea name="seo[og_description_ua]" class="form-control">
                        {{old('seo.og_description_ua')}}
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
