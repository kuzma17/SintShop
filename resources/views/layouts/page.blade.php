@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="link">
            @yield('link')
        </div>

        <h4>@yield('title')</h4>

        @yield('body')

    </div>
@endsection
