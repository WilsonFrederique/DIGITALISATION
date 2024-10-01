<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- ========= Css swiper ========= --}}
        <link rel="stylesheet" href="{{ asset('assets/swiper-bundle.min.css') }}">

        <!-- ========== Boxicon =========== -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- ========= REMIX ICON (remixicon.com) ============ -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>

        {{-- ======================== Mon dossier Css Personnel=========================== --}}
        <link rel="stylesheet" href="{{ asset('assets/style_Personnel.css') }}">
    </head>
    <body class="antialiased">

        {{-- ====== Navigation ====== --}}
        @include('navigation.navigation')

        {{-- ============ Container =========== --}}
        @yield('container')

        {{-- == Mon Dossier Script Personnel == --}}
        @include('script_Personnel')

    </body>
</html>
