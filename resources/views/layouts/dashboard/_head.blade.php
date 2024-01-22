<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>
    @isset($title)
        {{ $title }} |
    @endisset
    {{ config('app.name', 'Laravel') }}
</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="{{ config('app.name', 'Laravel') }}">
<meta name="author" content="">
<meta name="description" content="">
<meta name="keywords" content="" />
<link rel="canonical" href="{{ config('app.url') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ config('app.url') }}">
<meta property="og:title" content="{{ config('app.name', 'Laravel') }}">
<meta property="og:description" content="">
<meta property="og:image" content="">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ config('app.url') }}">
<meta property="twitter:title" content="{{ config('app.name', 'Laravel') }}">
<meta property="twitter:description" content="">
<meta property="twitter:image" content="">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="../../assets/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png">
<link rel="manifest" href="../../assets/img/favicon/site.webmanifest">
<link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">


<link rel="stylesheet" href="{{ mix('css/volt.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>

