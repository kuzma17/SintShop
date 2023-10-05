<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sint - Master shop') }} @yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
{{dd(gd_info())}}
    <div id="app">
        @include('layouts.preloader')
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
