@extends('user.app')

@section('sub_title')@lang('user.edit_password').@endsection
@section('user_content')

    <div class="user_password">
        <form method="post" action="{{route('user.password.update', $user->id)}}">
            {{method_field('PUT')}}
            @csrf
            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">@lang('user.password')</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">@lang('user.confirm_password')</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">
                </label>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-blue">@lang('user.save')</button>
                </div>
            </div>

        </form>
    </div>
@endsection

