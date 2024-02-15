@extends('user.app')
@section('sub_title')@lang('user.profile').@endsection
@section('user_content')

    <div class="user_settings">
        <form method="post" action="{{route('user.profile.update', $user->id)}}">
            {{method_field('PUT')}}
            @csrf
            <create-order
                    :deliveries="{{json_encode($deliveries)}}"
                    :payments="{{json_encode($payments)}}"
                    :user="{{json_encode($user)}}"
                    :validate_errors="{{$errors}}"
            ></create-order>
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

