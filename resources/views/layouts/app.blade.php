<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('logo/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-BpUhKniQ.css') }}"> --}}
</head>

<body class="font-sans antialiased bg-black">


    <div class="preloader-2" id= "loading">
        <span class="line line-1"></span>
        <span class="line line-2"></span>
        <span class="line line-3"></span>
        <span class="line line-4"></span>
        <span class="line line-5"></span>
        <span class="line line-6"></span>
        <span class="line line-7"></span>
        <span class="line line-8"></span>
        <span class="line line-9"></span>
        <div class="loading-txt">Loading</div>
    </div>

    <div id = "content" class="hidden min-h-screen bg-gradient-to-b from-blue-400 via-blue-300 to-blue-200">

        <div id="navbar" class="hidden">

            @include('layouts.navigation')

        </div>

        <main class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 ">

            {{ $slot }}

        </main>

    </div>

    <script>
        // jQuery to display content after the page has loaded
        $(window).on('load', function() {
            $('#loading').fadeOut(500, function() {
                $('#content').fadeIn(500);

            });

        });
    </script>

</body>

</html>
