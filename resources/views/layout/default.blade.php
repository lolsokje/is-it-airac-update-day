<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=rubik:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet"/>

    @vite('resources/css/app.css')
</head>
<body class="h-dvh bg-[#091227] text-white text-md lg:text-2xl px-4 lg:px-0">
    @yield('body')
</body>
</html>
