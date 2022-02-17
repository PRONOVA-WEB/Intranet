<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link text-gray-700" href="{{ route('rrhh.users.directory') }}">
                <i class="fas fa-address-book fa-fw" title="Teléfonos"></i> Directorio
            </a>

        </li>
        <li class="nav-item {{ active('calendars') }}">
            <a class="nav-link text-gray-700" href="{{ route('calendars') }}">
                <i class="fas fa-calendar-alt fa-fw" title="Calendarios"></i> Calendarios
            </a>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span
                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->full_name }}</span>
                    <i class="fas fa-user fa-fw" title="Calendarios"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('rrhh.users.show_form') }}">
                    <i class="fas fa-key"></i> Cambiar clave
                </a>
                @if (session()->has('superuser'))
                    <a class="dropdown-item" href="{{ route('rrhh.users.switch', session('superuser')) }}">
                        <i class="fas fa-eye text-danger"></i> Volver a superuser
                    </a>
                @endif


                @role('superuser')
                    <a class="dropdown-item" href="{{ route('parameters.index') }}">
                        <i class="fas fa-cog fa-fw"></i> Mantenedores
                    </a>
                    <a class="dropdown-item" href="{{ route('settings.index') }}">
                        <i class="fas fa-wrench"></i> <span>Parámetros</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('parameters.logs.index') }}">
                        <i class="fas fa-bomb fa-fw"></i> <span>Log de errores</span>
                    </a>
                @endrole


                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt fa-fw"></i> {{ __('Cerrar sesión') }}
                </a>

            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
