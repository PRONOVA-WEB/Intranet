<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
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
    <!-- Nav Item -  Estadísticas -->
    <li class="nav-item {{ active(['indicators.*']) }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEstadisticas"
            aria-expanded="true" aria-controls="collapseEstadisticas">
            <i class="fas fa-chart-line"></i>
            <span>Estadísticas</span>
        </a>
        <div id="collapseEstadisticas" class="collapse" aria-labelledby="headingEstadisticas"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('indicators.index') }}">
                    <i class="fas fa-desktop fa-fw"></i> Indicadores - REM
                </a>

                <a class="collapse-item" href="{{ route('indicators.population') }}">
                    <i class="fas fa-globe-americas"></i> Dashboard de población
                </a>

                @can('Programming: view')
                    <a class="collapse-item" href="{{ route('programmings.index') }}">
                        <i class="fas fa-calculator"></i> Programación Numérica
                    </a>

                    <a class="collapse-item" href="{{ route('communefiles.index') }}">
                        <i class="fas fa-file-alt"></i> Documentos Comunales
                    </a>
                @endcan

            </div>
        </div>
    </li>
    <!-- Nav Item - Documentos -->
    <li class="nav-item {{ active(['documents.*']) }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDocumentos"
            aria-expanded="true" aria-controls="collapseDocumentos">
            <i class="fas fa-file-alt fa-fw"></i>
            <span>Documentos</span>
        </a>
        <div id="collapseDocumentos" class="collapse" aria-labelledby="headingDocumentos"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['Documents: create', 'Documents: edit', 'Documents: add number', 'Documents: dev'])
                    <a class="collapse-item" href="{{ route('documents.index') }}">
                        <i class="fas fa-pen"></i> Generador
                    </a>
                @endcan

                @canany(['Documents: signatures and distribution'])
                    <a class="collapse-item" href="{{ route('documents.signatures.index', ['pendientes']) }}">
                        <i class="fas fa-signature"></i> Solicitud de firmas
                    </a>
                @endcan

                @canany(['Partes: oficina', 'Partes: user', 'Partes: director'])
                    <a class="collapse-item" href="{{ route('documents.partes.index') }}">
                        <i class="fas fa-file-import"></i> Partes
                    </a>
                @endcan

                @can('Agreement: view')
                    <a class=collapse-item" href="{{ route('agreements.tracking.index') }}">
                        <i class="fas fa-file"></i> Convenios
                    </a>
                @endcan

                <a class="collapse-item" href="{{ route('quality_aps.index') }}">
                    <i class="fas fa-file-alt"></i> Acreditación de Calidad
                </a>

                <a class="collapse-item" href="{{ route('health_plan.index', ['iquique']) }}">
                    <i class="fas fa-file-powerpoint"></i> Planes Comunales
                </a>

            </div>
        </div>
    </li>
    <!-- Nav Item - abastecimiento -->
    @if (env('APP_ENV') == 'local' || env('APP_ENV') == 'testing')
        <li class="nav-item {{ active(['request_forms.*']) }}">
            <a class="nav-link" href="{{ route('request_forms.my_forms') }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Abastecimiento</span>
            </a>
        </li>
    @endif
    <!-- Nav Item - SGR -->
    @can('Requirements: create')
        <li class="nav-item {{ active('requirements.*') }}">
            <a class="nav-link" href="{{ route('requirements.outbox') }}">
                <i class="fas fa-rocket"></i>
                <span>SGR
                    @if (App\Requirements\Requirement::getPendingRequirements())
                        <span
                            class="badge badge-secondary">{{ App\Requirements\Requirement::getPendingRequirements() }}</span>
                    @endif
                </span>
            </a>
        </li>
    @endcan

    @canany([
        'Users: create',
        'Users: edit',
        'Users: delete',
        'OrganizationalUnits: create',
        'OrganizationalUnits:
        edit',
        'OrganizationalUnits: delete',
        'Authorities: view',
        'Authorities: create',
        'Users: service requests',
        'Service Request',
        'Replacement Staff: create request',
        ])
        <!-- Nav Item - RRHH -->
        <li class="nav-item {{ active(['rrhh.*']) }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRRHH" aria-expanded="true"
                aria-controls="collapseRRHH">
                <i class="fas fa-fw fa-wrench"></i>
                <span>RRHH</span>
            </a>
            <div id="collapseRRHH" class="collapse" aria-labelledby="headingRRHH" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @canany(['Users: create', 'Users: edit', 'Users: delete'])
                        <a class="collapse-item" href="{{ route('rrhh.users.index') }}">
                            <i class="fas fa-user fa-fw"></i> Usuarios
                        </a>
                    @endcan

                    @canany(['OrganizationalUnits: create', 'OrganizationalUnits: edit', 'OrganizationalUnits: delete'])
                        <a class="collapse-item" href="{{ route('rrhh.organizational-units.index') }}">
                            <i class="fas fa-sitemap fa-fw"></i> Unidades organizacionales
                        </a>
                    @endcan

                    @can('Suitability: ssi')
                        <a class="collapse-item" href="{{ route('suitability.own') }}">
                            <i class="fas fa-chalkboard-teacher"></i> Idoneidad
                        </a>
                    @endcan

                    @canany(['Service Request', 'Service Request: report excel'])
                        <a class="collapse-item" href="{{ route('rrhh.service-request.home') }}">
                            <i class="fas fa-child fa-fw"></i> Contratación Honorarios
                        </a>
                    @endcan

                    @canany(['Shift Management: view'])
                        <a class="collapse-item" href="{{ route('rrhh.shiftManag.index') }}">
                            <i class="fa fa-calendar fa-fw"></i> Modulo Turnos
                        </a>
                    @endcan

                    @canany(['Users: service requests'])
                        <a class="collapse-item" href="{{ route('rrhh.users.service_requests.index') }}">
                            <i class="fas fa-user fa-fw"></i> Usuarios - Contrat. de Servicios
                        </a>
                    @endcan

                    @if (Auth::user()->hasRole('Replacement Staff: admin'))

                        <a class="collapse-item" href="{{ route('replacement_staff.request.index') }}">
                            <i class="far fa-id-card"></i> Solicitudes de Contratación
                        </a>
                    @endif

                    @if (Auth::user()->hasRole('Replacement Staff: user rys'))
                        <a class="collapse-item" href="{{ route('replacement_staff.request.assign_index') }}">
                            <i class="far fa-id-card"></i> Solicitudes de Contratación
                        </a>
                    @endif

                    @if (Auth::user()->hasRole('Replacement Staff: user') || App\Rrhh\Authority::getAmIAuthorityFromOu(Carbon\Carbon::now(), 'manager', Auth::user()->id))
                        <a class="collapse-item" href="{{ route('replacement_staff.request.own_index') }}">
                            <i class="far fa-id-card"></i> Solicitudes de Contratación
                            @if (App\Models\ReplacementStaff\RequestReplacementStaff::getPendingRequestToSign() > 0)
                                <span
                                    class="badge badge-secondary">{{ App\Models\ReplacementStaff\RequestReplacementStaff::getPendingRequestToSign() }}
                                </span>
                            @endif
                        </a>
                    @endif

                    @if (Auth::user()->hasRole('Replacement Staff: personal'))
                        <a class="collapse-item" href="{{ route('replacement_staff.request.personal_index') }}">
                            <i class="far fa-id-card"></i> Solicitudes de Contratación
                        </a>
                    @endif
                </div>
            </div>
        </li>
    @endcan
    @role('Drugs: admin|Drugs: receptionist|Drugs: basic')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('drugs.receptions.index') }}">
                <i class="fas fa-cannabis"></i> <span>Drogas</span></a>
        </li>
    @endrole

    @canany(['Asignacion Estimulos'])
        <li class="nav-item">
            <a class="nav-link" href="{{ route('assigment.index') }}">
                <i class="fas fa-wallet"></i> <span>Asign. Estímulos</span></a>
        </li>
    @endcan

    @canany([
        'Pharmacy: SSI (id:1)',
        'Pharmacy: REYNO (id:2)',
        'Pharmacy: APS (id:3)',
        'Pharmacy: Servicios generales
        (id:4)',
        ])
        <li class="nav-item {{ active('pharmacies.*') }}">
            <a class="nav-link" href="{{ route('pharmacies.index') }}">
                @canany(['Pharmacy: SSI (id:1)', 'Pharmacy: REYNO (id:2)']) <i class="fas fa-prescription-bottle-alt"></i>
                Droguería @endcan
                @can('Pharmacy: APS (id:3)') <i class="fas fa-list-ul"></i> Bodega APS @endcan
                @can('Pharmacy: Servicios generales (id:4)') <i class="fas fa-list-ul"></i> Bodega Servicios Generales
                @endcan
            </a>
        </li>
    @endcan

    <!-- Nav Item - Recursos Collapse Menu -->
    @canany(['Resources: create', 'Resources: edit', 'Resources: delete'])
        <li class="nav-item {{ active('resources.*') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRecursos"
                aria-expanded="true" aria-controls="collapseRecursos">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Recursos</span>
            </a>
            <div id="collapseRecursos" class="collapse" aria-labelledby="headingRecursos"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('resources.computer.index') }}">
                        <i class="fas fa-desktop fa-fw"></i>
                        <span>Computadores</span>
                    </a>

                    <a class="collapse-item" href="{{ route('resources.printer.index') }}">
                        <i class="fas fa-print fa-fw"></i>
                        <span>Impresoras</span>
                    </a>

                    <a class="collapse-item" href="{{ route('resources.telephone.index') }}">
                        <i class="fas fa-fax fa-fw"></i>
                        <span>Teléfonos Fijos</span>
                    </a>

                    <a class="collapse-item" href="{{ route('resources.mobile.index') }}">
                        <i class="fas fa-mobile-alt fa-fw"></i>
                        <span>Teléfonos Móviles</span>
                    </a>

                    <a class="collapse-item" href="{{ route('resources.wingle.index') }}">
                        <i class="fas fa-wifi fa-fw"></i>
                        <span>Banda Ancha Móvil</span>
                    </a>
                </div>
            </div>
        </li>
    @endcan

    @can('Mammography: admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('mammography.index') }}">Booking Mamografías</a>
        </li>
    @endcan
    <!-- Divider -->
    <hr class="sidebar-divider">
    @role('god')
        <!-- Heading -->
        <div class="sidebar-heading">
            Configuración
        </div>

        <!-- Nav Item - Mantenedor -->
        <li class="nav-item {{ active('parameters.*') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMantenedor"
                aria-expanded="true" aria-controls="collapseMantenedor">
                <i class="fas fa-fw fa-cog"></i>
                <span>Mantenedor</span>
            </a>
            <div id="collapseMantenedor" class="collapse" aria-labelledby="headingMantenedor"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('parameters.communes.index') }}">
                        <i class="fas fa-home"></i> Comunas</a>
                    <a class="collapse-item" href="{{ route('parameters.establishments.index') }}">
                        <i class="fas fa-hospital"></i> Establecimientos</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Permisos:</h6>
                    <a class="collapse-item" href="{{ route('parameters.permissions.index', 'web') }}">
                        <i class="fas fa-chalkboard-teacher"></i> Internos
                    </a>
                    <a class="collapse-item" href="{{ route('parameters.permissions.index', 'external') }}">
                        <i class="fas fa-external-link-alt"></i> Externos
                    </a>
                    <a class="collapse-item" href="{{ route('parameters.holidays.index') }}">
                        <i class="fas fa-suitcase"></i> Feriados</a>
                    <a class="collapse-item" href="{{ route('parameters.roles.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i> Roles</a>
                    <a class="collapse-item" href="{{ route('parameters.locations.index') }}">
                        <i class="fas fa-home"></i> Ubicaciones</a>
                    <a class="collapse-item" href="{{ route('parameters.places.index') }}">
                        <i class="fas fa-map-marker-alt"></i> Lugares</a>
                    <a class="collapse-item"
                        href="{{ route('parameters.phrases.index') }}">
                        <i class="fas fa-smile-beam"></i> Frases del día</a>
                    <a class="collapse-item"
                        href="{{ route('parameters.professions.index') }}">
                        <i class="fas fa-external-link-alt"></i> Profesiones</a>
                    <a class="collapse-item"
                        href="{{ route('parameters.budgetitems.index') }}">
                        <i class="fas fa-file-invoice-dollar"></i> Item Presupuestario</a>
                    <a class="collapse-item"
                        href="{{ route('parameters.measurements.index') }}">
                        <i class="fas fa-ruler-combined"></i> Unidades de Medida</a>
                    <a class="collapse-item"
                        href="{{ route('parameters.purchasemechanisms.index') }}">
                        <i class="fas fa-shopping-cart"></i> Mecanismos de Compra</a>
                    <a class="collapse-item"
                        href="{{ route('parameters.purchasetypes.index') }}">
                        <i class="fas fa-shopping-cart"></i> Tipos de Compra</a>
                    <a class="collapse-item"
                        href="{{ route('parameters.purchaseunits.index') }}">
                        <i class="fas fa-shopping-cart"></i> Unidades de Compra</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endrole
</ul>
<!-- End of Sidebar -->
