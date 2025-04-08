@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="link">
            @yield('link')
        </div>

        <h1>@yield('name_page')</h1>

        @yield('body')

    </div>
@endsection
