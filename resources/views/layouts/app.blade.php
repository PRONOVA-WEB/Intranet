<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <meta content="Pronova" name="author" />
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('custom_js_head')

    <!-- Fonts -->
    <link href="{{ asset('fonts/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Styles -->
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style media="screen">
        .bg-gradient-primary {
            @switch(env('APP_ENV')) @case('local') background-color: rgb(73, 17, 82); @break @case('testing') background-color: rgb(2, 82, 0); @break @case('production')@if (env('APP_DEBUG') == true)background-color: rgb(255, 0, 0);
            @endif@break;
        @endswitch background-image: none;
    }

</style>
@yield('custom_css')
@livewireStyles
</head>

<body>

<div id="wrapper">
    @include('layouts.partials.menu')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            @include('layouts.partials.topbar')
            <!-- Begin Page Content -->
            <div class="container-fluid">
                @include('layouts.partials.errors')
                @include('layouts.partials.flash_message')
                @yield('content')
            </div>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; {{ env('APP_NAME') }} 2021</span>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- scripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script src="https://cdn.amcharts.com/lib/version/4.9.34/core.js"></script>
<script src="https://cdn.amcharts.com/lib/version/4.9.34/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/version/4.9.34/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/version/4.9.34/themes/animated.js"></script>

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
    integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
    crossorigin="anonymous" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>

@yield('custom_js')
@livewireScripts
</body>

</html>
