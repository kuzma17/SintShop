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
    <!-- Google Tag Manager -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WBRRP3QC"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WBRRP3QC');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <div id="app">
        @include('layouts.preloader')
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')

        <callback-button></callback-button>
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
{{--    <script src="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/Snow.min.js"></script>--}}
{{--    <script>--}}
{{--        new Snow ();--}}
{{--    </script>--}}

    <script>
        (function(d,t) {
            var BASE_URL="https://app.chatwoot.com";
            var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=BASE_URL+"/packs/js/sdk.js";
            g.defer = true;
            g.async = true;
            s.parentNode.insertBefore(g,s);
            g.onload=function(){
                window.chatwootSDK.run({
                    websiteToken: 'gyShvxyfnT4pzM6V4NVpScEk',
                    baseUrl: BASE_URL
                })
            }
        })(document,"script");
    </script>
</body>
</html>
