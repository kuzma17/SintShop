<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sint - Master shop') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
{{--    <link href="{{ asset('/build/assets/app-76742b4c.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('/build/assets/app-260f9e7e.css') }}" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">--}}

</head>
<body>
    <div id="app">
        @include('layouts.preloader')
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>
    {{--    <script async src="{{ asset('/build/assets/app-ad077736.js') }}"></script>--}}
    {{--    <script async src="{{ asset('/build/assets/ru-ef69a4e1.js') }}"></script>--}}
    {{--    <script async src="{{ asset('/build/assets/ua-cc329ed6.js') }}"></script>--}}
</body>
</html>
