@extends('admin.layouts.app')

@section('content')
    <h4>Редактирование бренда</h4>
    <div class="good">
        <form name="category" method="post" enctype="multipart/form-data" action="{{route('admin.vendors.update', $vendor->id)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$vendor->id}}">
            <div class="row mb-3">
                <label class="col-2 star">
                    Наименование
                </label>
                <div class="col-9">
                    <input type="text" name="title" value="{{old('name_ru', $vendor->title)}}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

{{--            <div class="row mb-3">--}}
{{--                <label class="col-2">--}}
{{--                    Картинка--}}
{{--                </label>--}}
{{--                <div class="col-9">--}}
{{--                    <input-image--}}
{{--                        path="/images"--}}
{{--                        :model-value="{{json_encode(old('images', $vendor->image))}}"--}}
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
