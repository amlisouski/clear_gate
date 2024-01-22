<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.dashboard._head')
</head>

<body>
@include('layouts.dashboard._nav')
@include('layouts.dashboard._sidenav')

<main class="content">
    @include('layouts.dashboard._topbar')

    {{ $slot }}
    @yield('content')

    @include('layouts.dashboard._footer')

    @if( session('status') && session('status_message'))
        <x-notyf :status="session('status')" :message="session('status_message')"></x-notyf>
    @endif
</main>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
{{--@yield('footer-scripts')--}}
@stack('footer-scripts')
</body>
</html>
