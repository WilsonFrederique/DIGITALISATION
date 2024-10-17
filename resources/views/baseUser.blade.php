<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- ========= Css swiper ========= --}}

        <!-- ========== Boxicon =========== -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- ========= REMIX ICON (remixicon.com) ============ -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>

        {{-- =================== Boxicon ================== --}}
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        {{-- ======================== Mon dossier Css Personnel=========================== --}}
        <link rel="stylesheet" href="{{ asset('assets/cssUser/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/cssUser/specialiste.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/cssUser/styleModifPassword.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/cssUser/styleFrmPermission.css') }}">

    </head>
    <body class="antialiased">

        {{-- ====== Navigation ====== --}}
        @include('navigationUser.navigationUser')

        {{-- ============ Container =========== --}}
        @yield('containerUser')

        {{-- == Mon Dossier Script Personnel == --}}
        @include('script_User')

    </body>
</html>
