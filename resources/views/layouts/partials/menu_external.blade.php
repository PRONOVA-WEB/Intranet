<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img src="@settings(site.logo)" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3">@settings(site.title)</div>
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
