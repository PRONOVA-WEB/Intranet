<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ settings('site.title')  }} | @yield('title')</title>
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
    <link href="{{ asset('css/intranet.css') }}" rel="stylesheet">
    <style media="screen">
        .bg-gradient-primary {
            @switch(env('APP_ENV')) @case('local') background-color: rgb(109, 108, 108 ); @break @case('testing') background-color: rgb(38, 83, 212, 0); @break @case('production')@if (env('APP_DEBUG') == true)background-color: rgb(255, 0, 0);
            @endif@break;
        @endswitch background-image: none;
    }
    </style>
@yield('custom_css')
@livewireStyles
</head>
<body>
    <div id="wrapper">
        @include('layouts.partials.menu_external')
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
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
                        <span>Copyright &copy; {{ settings('site.title') }} {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
    function logout(){
        // llamada al endpoint de logout
        window.location.href="https://accounts.claveunica.gob.cl/api/v1/accounts/app/logout";

        // redirección al cabo de 1 segundo a un handler de logout en la aplicación integradora
        setTimeout(function(){ window.location.href= "/logout"; }, 1000);
    }
    </script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @livewireScripts
</body>

</html>
