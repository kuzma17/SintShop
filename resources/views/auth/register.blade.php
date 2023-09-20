@extends('layouts.page')

@section('link')
    {{ Breadcrumbs::render('register') }}
@endsection

@section('title', __('main.register'))

@section('body')
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="">--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="name" class="col-md-3 col-form-label text-md-end star">--}}
{{--                                {{ __('Name') }}--}}
{{--                            </label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="phone" class="col-md-3 col-form-label text-md-end star">--}}
{{--                                Phone--}}
{{--                            </label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="phone" type="text" class="form-control @error('email') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">--}}

{{--                                @error('phone')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-3 col-form-label text-md-end">--}}
{{--                                {{ __('Email Address') }}--}}
{{--                            </label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                                                <strong>{{ $message }}</strong>--}}
{{--                                                            </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-3 col-form-label text-md-end star">--}}
{{--                                {{ __('Password') }}--}}
{{--                            </label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password-confirm" class="col-md-3 col-form-label text-md-end star">--}}
{{--                                {{ __('Confirm Password') }}--}}
{{--                            </label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-3">--}}
{{--                                <button type="submit" class="btn btn-blue">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}




<div class="user_settings">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h5>@lang('user.contacts_data')</h5>
        <div class="content">

            <div >
                <div  class="login">
                    <div class="mb-3 row">
                        <label class="col-sm-3 star">
                            @lang('user.name')
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"
                                   required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 star">
                            @lang('user.phone')
                        </label>
                        <div class="col-sm-9">
                            <input-phone
                                name="phone"
                                model-value="{{old('phone')}}"
                                class="@error('phone') is-invalid @enderror"
                                placeholder=""
                            ></input-phone>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3">
                            e-mail
                        </label>
                        <div class="col-sm-9">
                            <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-3 star">
                            {{ __('user.password') }}
                        </label>

                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-3 star">
                            {{ __('user.confirm_password') }}
                        </label>

                        <div class="col-md-9">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <h5>@lang('user.delivery')</h5>

        <delivery-choice
            :deliveries="{{json_encode($deliveries)}}"
            model-value="{{old('delivery_id')}}"
            address="{{old('delivery_address')}}"
            :validate_errors="{{$errors}}"
        >
        </delivery-choice>
        <h5>@lang('user.payment')</h5>
        <div class="content">
            <ul>
                @foreach($payments as $payment)
                    <li>
                        <input type="radio"
                               id="payment{{$payment->id}}"
                               value="{{$payment->id}}"
                               name="payment_id"
                            @checked($payment->id == old('payment_id', $loop->first))
                        >
                        <label for="payment{{$payment->id}}">{{ $payment->title }}</label>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2">
            </label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-blue">@lang('user.save')</button>
            </div>
        </div>

    </form>
</div>

@endsection
