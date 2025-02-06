@extends('admin.layouts.app')

@section('content')
    <h4>Создание Пользователя</h4>
    <div class="good">
        <form name="user" method="post" enctype="multipart/form-data" action="{{route('admin.users.store')}}">
            @csrf
            <div class="row mb-3">
                <label class="col-2 star">
                    Имя
                </label>
                <div class="col-9">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 star">
                    Login
                </label>
                <div class="col-9">
                    <input type="text" name="login" value="{{old('login')}}" class="form-control @error('login') is-invalid @enderror">
                    @error('login')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
                    Пароль
                </label>
                <div class="col-9">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
                    Подтверждение пароля
                </label>
                <div class="col-9">
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-2 star">
                    Роль
                </label>
                <div class="col-9">
                    <select name="role_id" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" @selected(old('role_id') == $role->id)>{{$role->name}}</option>
                        @endforeach
                    </select>
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
