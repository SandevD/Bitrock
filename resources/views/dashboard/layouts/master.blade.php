<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- head  -->
    @hasSection('head')
    @yield('head')
    @else
    <title>Dashboard | {{ config('app.name', 'Laravel') }}</title>
    @endif
    <!-- /.head -->

    <!-- Icon -->
    <link rel="icon" href="/assets/img/arrow.png">

    <!-- css  -->
    @include('dashboard.layouts.css')
    <!-- /.css -->

</head>

<body class="bg-dark" style="
            background: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)),url('/assets/css/bimg/mainbg.png');
            max-width: 100%;
            background-repeat: no-repeat;
            min-height: 100vh;
            background-size:cover;">
    <div class="d-flex" id="wrapper">
        <!-- Header START -->
        @include('dashboard.layouts.nav')
        <div id="page-content-wrapper">
            @include('dashboard.layouts.topnav')

            <!-- Header END -->

            @yield('content')
        </div>

    </div>

    <!-- js  -->
    @include('dashboard.layouts.js')
    @include('partials.notify')
    <!-- /.js -->
</body>

</html>
