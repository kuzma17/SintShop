@extends('admin.layouts.app')

@section('content')
    <h4>Параметры</h4>
    <div class="good">
        <form name="category" method="post" action="{{route('admin.settings.update')}}">
            @csrf
            <div class="row mb-3">
                <label class="col-2 star">
                    Site_title ru
                </label>
                <div class="col-9">
                    <input type="text" name="site_title__ru" value="{{old('site_title__ru', $settings['site_title__ru'])}}" class="form-control @error('site_title__ru') is-invalid @enderror">
                    @error('site_title__ru')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Site_title ua
                </label>
                <div class="col-9">
                    <input type="text" name="site_title__ua" value="{{old('site_title__ua', $settings['site_title__ua'])}}" class="form-control @error('site_title_ua') is-invalid @enderror">
                    @error('site_title_ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
                    Site_keywords ru
                </label>
                <div class="col-9">
                    <input type="text" name="site_keywords__ru" value="{{old('site_keywords__ru', $settings['site_keywords__ru'])}}" class="form-control @error('site_keywords__ru') is-invalid @enderror">
                    @error('site_keywords__ru')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Site_description ua
                </label>
                <div class="col-9">
                    <input type="text" name="site_keywords__ua" value="{{old('site_keywords__ua', $settings['site_keywords__ua'])}}" class="form-control @error('site_keywords__ua') is-invalid @enderror">
                    @error('site_keywords__ua')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2">
                    Site_description ru
                </label>
                <div class="col-9">
                    <textarea name="site_description__ru" class="form-control">
                        {{old('description__ru', $settings['site_description__ru'])}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2">
                    Site_description ua
                </label>
                <div class="col-9">
                    <textarea name="site_description__ua" class="form-control">
                        {{old('description__ua', $settings['site_description__ua'])}}
                    </textarea>
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
