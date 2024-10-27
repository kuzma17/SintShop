<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('seo.site_title'))</title>
    <meta name="description" content="@yield('description', __('seo.site_description'))">
    <meta name="keywords" content="@yield('keywords', __('seo.site_keywords'))">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
{{--    <link href="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/snow.min.css" rel="stylesheet">--}}
</head>
<body>
    <div id="app">
        @include('layouts.preloader')
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
{{--    <script src="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/Snow.min.js"></script>--}}
{{--    <script>--}}
{{--        new Snow ();--}}
{{--    </script>--}}

</body>
</html>
