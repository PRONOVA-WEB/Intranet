<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a
            class="nav-link {{ active('inventories.index') }}"
            aria-current="page"
            href="{{ route('inventories.index') }}"
        >
            <i class="fas fa-list-alt"></i> Inventario
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link {{ active('inventories.last-receptions') }}"
            href="{{ route('inventories.last-receptions') }}"
        >
        <i class="fas fa-clock"></i> Últimos Ingresos a Bodega
        </a>
    </li>
    <li class="nav-item">
        <a
            class="nav-link {{ active(['inventories.pending-inventory', 'inventories.edit']) }}"
            href="{{ route('inventories.pending-inventory') }}"
        >
            <i class="fas fa-hourglass"></i> Bandeja Pendiente de Inventario
        </a>
    </li>
    <li class="nav-item dropdown">
        <a
            class="nav-link dropdown-toggle  {{ active('inventories.places') }}"
            data-toggle="dropdown"
            href="#"
            role="button"
            aria-expanded="false"
        >
            <i class="fas fa-cog"></i> Mantenedores
        </a>
        <div class="dropdown-menu">
            <a
                class="dropdown-item"
                href="{{ route('inventories.places') }}"
            >
                <i class="fas fa-file-alt"></i> Lugares
            </a>
        </div>
    </li>
</ul>
