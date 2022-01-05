<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link text-gray-700" href="{{ route('rrhh.users.directory') }}">
                <i class="fas fa-address-book fa-fw" title="Teléfonos"></i> Directorio telefónico
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
                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->firstName }}</span>
                    <i class="fas fa-user fa-fw" title="Calendarios"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                @if (session()->has('god'))
                    <a class="dropdown-item" href="{{ route('rrhh.users.switch', session('god')) }}">
                        <i class="fas fa-eye text-danger"></i> God Like
                    </a>
                @endif


                @role('god')
                    <a class="dropdown-item" href="{{ route('parameters.index') }}">
                        <i class="fas fa-cog fa-fw"></i> Mantenedores
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
