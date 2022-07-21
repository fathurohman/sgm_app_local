<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/css/my.css" rel="stylesheet">
    @stack('css')
</head>

<body class="{{ $class ?? '' }}">
    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('layouts.navbars.sidebar')
    @endauth

    <div class="main-content">
        @include('layouts.navbars.navbar')
        @yield('content')
    </div>

    @guest()
        @include('layouts.footers.guest')
    @endguest

    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('argon') }}/js/jquery-ui.min.js"></script>

    @stack('js')

    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    <script type="text/javascript">
        if ($('li.nav-vc').hasClass('active')) {
            //ada class active
            $('li.nav-vc a').removeClass('collapsed').attr("aria-expanded", "true");
            // var thisID = $('.collapse').addClass('show');
            var thisID = $('li.nav-vc a').next().addClass('show');
            // console.log(thisID);
        }
        if ($('li.nav-pa').hasClass('active')) {
            //ada class active
            $('li.nav-pa a').removeClass('collapsed').attr("aria-expanded", "true");
            var thisID = $('li.nav-pa a').next().addClass('show');
        }
        if ($('li.nav-tr').hasClass('active')) {
            //ada class active
            $('li.nav-tr a').removeClass('collapsed').attr("aria-expanded", "true");
            var thisID = $('li.nav-tr a').next().addClass('show');
        }
        if ($('li.nav-inv').hasClass('active')) {
            //ada class active
            $('li.nav-inv a').removeClass('collapsed').attr("aria-expanded", "true");
            var thisID = $('li.nav-inv a').next().addClass('show');
        }
        if ($('li.nav-hist').hasClass('active')) {
            //ada class active
            $('li.nav-hist a').removeClass('collapsed').attr("aria-expanded", "true");
            var thisID = $('li.nav-hist a').next().addClass('show');
        }
    </script>
</body>

</html>
