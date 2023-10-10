@extends('user.app')
@section('sub_title')@lang('user.profile').@endsection
@section('user_content')

    <div class="user_settings">
        <form method="post" action="{{route('user.profile.update', $user->id)}}">
            {{method_field('PUT')}}
            @csrf
        <h5>@lang('user.contacts_data')</h5>
        <div class="content">

            <div >
                <div  class="login">
                    <div class="mb-3 row">
                        <label class="col-sm-2 star">
                            @lang('user.name')
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}"
                                    required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 star">
                            @lang('user.phone')
                        </label>
                        <div class="col-sm-10">
                            <input-phone
                                name="phone"
                                model-value="{{$user->phone}}"
                                class="@error('phone') is-invalid @enderror"
                                placeholder=""
                                required="required"
                            ></input-phone>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">
                            e-mail
                        </label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">
                        </label>

                    </div>
                </div>

            </div>
        </div>
        <h5>@lang('user.delivery')</h5>

        <delivery-choice
            :deliveries="{{json_encode($deliveries)}}"
            model-value="{{$user->delivery_id}}"
            :address="{{json_encode($user->delivery_address)}}"
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
                            @checked($payment->id == $user->payment_id)
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

