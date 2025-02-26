<!-- SEO Meta Tags -->
<title>{{ $seo['meta_title'] ?? config('app.name') }}</title>
<meta name="description" content="{{ $seo['meta_description'] ?? '' }}">
<meta name="keywords" content="{{ $seo['meta_keywords'] ?? '' }}">

<!-- Open Graph Tags -->
<meta property="og:title" content="{{ $seo['og_title'] ?? '' }}">
<meta property="og:description" content="{{ $seo['og_description'] ?? '' }}">
