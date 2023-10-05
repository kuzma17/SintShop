<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sint - Master shop') }} @yield('title')</title>
{{--    <link href="{{ asset('css/all.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
</head>
<body>
<div id="app">
    <div class="admin">
        <div class="row">
            <div class="sidebar p-0">
                <div class="logo">
                    SintAdmin
                </div>
                <div class="user">
                    admin online
                </div>
                @include('admin.layouts.menu')

            </div>
            <div class="col p-0">
                <div class="header">
                    Header
                </div>
                <div class="content">
                    <div class="body">
                        @yield('content')

                    </div>
                </div>

            </div>

            <div id="top-scroll" class="top-scroll">
                <a href="#" title="вверх"><span class="fas fa-angle-up"></span></a>
            </div>

        </div>
    </div>

</div>
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
<script src="{{ mix('js/admin.js') }}" defer></script>
</body>
</html>
