@props(['theme'])

@php
    $themes = [
        'light' => 'post--light',
        'dark' => 'post--dark',
        'sepia' => 'post--sepia',
        'forest' => 'post--forest',
        'ocean' => 'post--ocean',
        'sunset' => 'post--sunset',
    ];

    $themeClass = $themes[$theme ?? 'light'];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('scripts')
</head>

<body class="{{ $themeClass }}">
    <div class="font-sans antialiased">
        {{ $slot }}
    </div>
</body>

</html>