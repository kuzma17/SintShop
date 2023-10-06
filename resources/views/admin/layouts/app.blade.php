<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sint - Master shop') }} @yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
</head>
<body>
<div id="app">
        <div class="row admin">
            <div class="sidebar ">
                <div class="logo">
                    SintAdmin
                </div>
                <div class="user">
                    admin online
                </div>
                <br>
                @include('admin.layouts.menu')

            </div>
            <div class="col p-0">
                <div class="header">
                    <div class="row">
                        <div class="col-11"></div>
                        <div class="col-1">
                            <div class="auth-admin dropdown">
                                <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i> {{auth()->user()->name}}</span>
                                <div class="dropdown-menu">

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                            {{ csrf_field() }}
                                            <button type="submit" class="list-group-item list-group-item-action">
                                                <i class="fa-solid fa-right-from-bracket"></i> @lang('user.exit')
                                            </button>
                                        </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="body">
                        @yield('content')

                    </div>
                </div>

            </div>

    </div>

</div>
<script src="{{ mix('js/admin.js') }}" defer></script>
</body>
</html>
