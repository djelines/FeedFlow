<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome pour les icônes -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJ8yS47Xb3f5z/SgW4tV3o3p5K5s00t2J+y4r3w/q/z6/I6/gW0G4tH4Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Stock and get dark mode data--}}
        <script>
            (function () {
                const html = document.documentElement;
                const stored = localStorage.getItem('theme');

                if (stored === 'dark') {
                    html.classList.add('dark');
                    html.classList.remove('white');
                } else {
                    html.classList.remove('dark');
                    html.classList.add('white');
                }
            })();
        </script>
    </head>

    <body class="font-sans antialiased bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        @include('components.toast')


    @include('layouts.navigation')


    </body>
</html>
