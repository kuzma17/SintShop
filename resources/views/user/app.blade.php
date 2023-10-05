@extends('layouts.page')

@section('link', Breadcrumbs::render('user.profile'))

@section('title')
    @lang('user.cabinet'). @yield('sub_title')
@endsection

@section('body')

        <div class="row cabinet">
            <div class="col-3 p-0">
                <div class="list-group menu">
                    <a href="{{route('user.profile')}}" class="list-group-item list-group-item-action">@lang('user.profile')</a>
                    <a href="{{route('user.password')}}" class="list-group-item list-group-item-action">@lang('user.edit_password')</a>
                    <a href="{{route('user.orders')}}" class="list-group-item list-group-item-action">@lang('user.orders')</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        {{ csrf_field() }}
                        <button type="submit" class="list-group-item list-group-item-action">@lang('user.exit')</button>
                    </form>
                </div>
            </div>
            <div class="col-9">
                @yield('user_content')
            </div>
        </div>

@endsection
