<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />


    <!-- Icon -->
    <link rel="icon" href="/assets/img/arrow.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bitrock') }} | Login</title>

    <style>
    </style>
    <!-- css  -->
    @include('layouts.css')
    <!-- /.css -->

</head>

<body style="
            background: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url('/assets/css/bimg/mainbg.png');
            max-width: 100%;
            background-repeat: no-repeat;
            min-height: 100vh;
            background-size:cover;">

    @yield('content')
    <!-- js  -->
    @include('layouts.js')
    @include('partials.notify')
    <!-- /.js -->
</body>

</html>
