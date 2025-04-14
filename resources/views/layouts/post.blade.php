@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="link">
            @yield('link')
        </div>

        <div class="row">
            <div class="col-12 col-md-auto custom-left">
                @include('layouts.callback')
                <x-office-list></x-office-list>
            </div>
            <div class="col-12 col-md">
                <h1>@yield('name_post')</h1>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @yield('body')
            </div>
        </div>

    </div>
@endsection
