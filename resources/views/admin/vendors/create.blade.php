@extends('admin.layouts.app')

@section('content')
    <h4>Создание бренда</h4>
    <div class="good">
        <form name="good" method="post" enctype="multipart/form-data" action="{{route('admin.vendors.store')}}">
            @csrf
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование
                </label>
                <div class="col-9">
                    <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

{{--            <div class="row mb-3">--}}
{{--                <label class="col-2">--}}
{{--                    Logo--}}
{{--                </label>--}}
{{--                <div class="col-9">--}}
{{--                    <input-image--}}
{{--                        path="/images"--}}
{{--                    ></input-image>--}}
{{--                </div>--}}
{{--            </div>--}}


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
