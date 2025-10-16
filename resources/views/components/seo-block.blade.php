
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<link rel="canonical" href="{{ $url }}">

@if(!empty($noindex))
    <meta name="robots" content="noindex, nofollow">
@else
    <meta name="robots" content="index,follow">
@endif

<!-- Open Graph -->
<meta property="og:locale" content="{{ str_replace('-', '_', app()->getLocale()) }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('seo.name') }}">
<meta property="og:title" content="{{ $og_title ?? $title }}">
<meta property="og:description" content="{{ $og_description ?? $description }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="{{ $og_title ?? $title }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ config('seo.twitter') }}">
<meta name="twitter:title" content="{{ $og_title ?? $title }}">
<meta name="twitter:description" content="{{ $og_description ?? $description }}">
<meta name="twitter:image" content="{{ $image }}">

<!-- JSON-LD -->
@if(!empty($json_ld))
    <script type="application/ld+json">
        {!! json_encode($json_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endif