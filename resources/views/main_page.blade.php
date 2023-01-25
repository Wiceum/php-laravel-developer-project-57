<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    <link href="{{ asset('css/app.css', $_ENV['IS_ASSETS_SECURE']) }}" rel="stylesheet">
    <title>{{__(config('app.name'))}}</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="{{ asset('js/app.js', $_ENV['IS_ASSETS_SECURE']) }}"></script>
</head>
<body>
<div id="app">
    @include('components/header')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
             @yield('content')
        </div>
    </section>
</div>
<x-flash/>
</body>
</html>
