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
    <script src="https://kit.fontawesome.com/7c4f606aba.js" SameSite="None" crossorigin="anonymous"></script>
    <link href="{{ asset('css/cu.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/show-password-toggle.min.css') }}">
    <style media="screen">
        .locallogin {
            background-color: #e7e7e7;
            color: black;
            border: none;
            padding: 9px 26px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

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
        @if(Auth::guard('external')->check())
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                    <div class="sidebar-brand-icon">
                        <img src="{{ settings('site.logo') }}" class="img-fluid">
                    </div>
                    <div class="sidebar-brand-text mx-3"> {{ settings('site.title') }}</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0 mt-3" id="sidebarToggle"></button>
                </div>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Menú
                </div>
                <li class="nav-item {{ active('invoice.*') }}">
                    <a class="nav-link" href="{{ route('invoice.welcome') }}">
                        <i class="fas fa-file-invoice" aria-hidden="true"></i>
                        <span>Contratos Honorarios
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ active('replacement_staff.*') }}">
                    <a class="nav-link" href="{{ route('replacement_staff.create') }}">
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                        <span>Staff de Reemplazo
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <i class="fa fa-window-close" aria-hidden="true"></i>
                        <span>Cerrar Sesión
                        </span>
                    </a>
                </li>

            </ul>
        @endif
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        @if(Auth::guard('external')->check())
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('external')->user()->full_name }}</span>
                                    <i class="fas fa-user fa-fw" title="Calendarios"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-fw"></i> {{ __('Cerrar sesión') }}
                                </a>

                            </div>
                        </li>
                        @endif
                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
     @yield('custom_js')
    @livewireScripts
</body>

</html>
