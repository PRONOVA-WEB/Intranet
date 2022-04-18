@extends('layouts.app')

@section('title', 'Gestion de Turnos')

@section('custom_css')
    <style>
        .table td,
        .table th {
            vertical-align: middle !important;
        }

    </style>
@endsection
@section('content')

    @include('rrhh.shift_management.tabs', ['actuallyMenu' => 'indexTab'])

    <div class="row mb-3 mt-2">
        <div class="col-md-12">
            <h3> Gestión de Turnos</h3>
        </div>
    </div>
    <form method="get" action="{{ route('rrhh.shiftManag.index') }}">
        <!-- Menu de Filtros  -->
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="for_name">Unidad organizacional</label>
                <select class="form-control selectpicker" id="for_orgunitFilter" name="orgunitFilter" data-live-search="true"
                    required data-size="5">
                    @foreach ($ouRoots as $ouRoot)
                        @if ($ouRoot->name != 'Externos')
                            <option value="{{ $ouRoot->id }}"
                                {{ $ouRoot->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                {{ $ouRoot->id ?? '' }}-{{ $ouRoot->name }}
                            </option>
                            @foreach ($ouRoot->childs as $child_level_1)
                                <option value="{{ $child_level_1->id }}"
                                    {{ $child_level_1->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp;&nbsp;
                                    {{ $child_level_1->id ?? '' }}-{{ $child_level_1->name }}
                                </option>
                                @foreach ($child_level_1->childs as $child_level_2)
                                    <option value="{{ $child_level_2->id }}"
                                        {{ $child_level_2->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ $child_level_2->id ?? '' }}-{{ $child_level_2->name }}
                                    </option>
                                    @foreach ($child_level_2->childs as $child_level_3)
                                        <option value="{{ $child_level_3->id }}"
                                            {{ $child_level_3->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $child_level_3->id ?? '' }}-{{ $child_level_3->name }}
                                        </option>
                                        @foreach ($child_level_3->childs as $child_level_4)
                                            <option value="{{ $child_level_4->id }}"
                                                {{ $child_level_4->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $child_level_4->id ?? '' }}-{{ $child_level_4->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="estamento">Estamento</label>
                <select class="form-control" name="position">
                    <option value="">Todos</option>
                    @foreach ($staff->groupBy('position') as $key => $position_name)
                        <option {{ ($position == $key) ? 'selected' : '' }}>{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="for_name" class="input-group-addon">Series</label>
                <select class="form-control" id="for_turnFilter" name="turnFilter">
                    {{-- <option value="0">0 - Todas</option> --}}
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($sTypes as $st)
                        @foreach ($actuallyShiftMonthsList as $key => $shiftMonth)
                            @foreach ($shiftMonth as $sMonth)
                                @if ($sMonth->shift_type_id == $st->id && $sMonth->user_id == auth()->user()->id && $sMonth->month == $actuallyMonth)
                                    <option value="{{ $st->id }}"
                                        {{ $st->id == $actuallyShift->id ? 'selected' : '' }}>{{ $index }} -
                                        {{ $st->name }}</option>
                                    {{-- json_encode($sMonth) --}}
                                @endif
                            @endforeach
                        @endforeach
                        @php
                            $index++;
                        @endphp
                    @endforeach
                    <!-- <option value="99">99 - Solo Turno Personalizado</option> -->
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="for_name">Fecha</label>
                <input type="month" class="form-control" name="monthYearFilter"
                    value="{{ $actuallyYear . '-' . $actuallyMonth }}">
            </div>

            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button class="btn btn-primary form-control">Filtrar</button>
            </div>
        </div>
    </form>
    <!-- Select con personal de la unidad  -->
    <h4 class="mt-2 mb-2">Agregar personal al <b>{{ $actuallyShift->name }}</b></h4>

    <form method="POST" action="{{ route('rrhh.shiftsTypes.assign') }}" class="mb-3">
        @csrf
        @method('POST')
        <input hidden name="dateFrom" value="{{ $actuallyYear }}-{{ $actuallyMonth }}-01">
        <input hidden name="dateUp" value="{{ $actuallyYear }}-{{ $actuallyMonth }}-{{ $days }}">
        <input hidden name="shiftId" value="{{ $actuallyShift->id }}">
        <input hidden name="orgUnitId" value="{{ $actuallyOrgUnit->id }}">
        <div class="form-row">
            <div class="col-md-6">
                <label>Personal de "{{ $actuallyOrgUnit->name }}"</label>
                <select class="selectpicker form-control" data-live-search="true" name="slcStaff" required>
                    <option value=""> - </option>
                    @foreach ($staff as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->runFormat() }} - {{ $user->fullName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <label>Inicio</label>
                <select class="form-control" name="initialSerie">
                    @if (isset($actuallyShift->day_series))
                        @php $currentSeries =  explode(",", $actuallyShift->day_series); @endphp
                        @for ($i = 0; $i < sizeof($currentSeries); $i++)
                            @if ($currentSeries[$i] != '')
                                <option value="{{ $i }}">{{ intval($i + 1) }} - {{ $currentSeries[$i] }}
                                </option>
                            @endif
                        @endfor
                    @endif
                </select>
            </div>
            <div class="col-md-2">
                <label>De</label>
                <input type="date" class="form-control" name="dateFromAssign"
                    value="{{ $actuallyYear }}-{{ $actuallyMonth }}-01">
            </div>
            <div class="col-md-2 ">
                <label>Hasta</label>
                <input type="date" class="form-control" name="dateUpAssign"
                    value="{{ $actuallyYear }}-{{ $actuallyMonth }}-{{ $days }}">
            </div>
            <div class="col-md-1">
                <label>&nbsp;</label>
                <button class="btn btn-success form-control">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
        </div>

    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 py-3 border-left-primary">
                <div class="card-body">
                    <h4>
                        @foreach ($months as $index => $month)
                            {{ $index == $actuallyMonth ? $month : '' }}
                        @endforeach

                        {{ $actuallyYear }}
                        -
                        {{ $actuallyShift->name }}
                    </h4>
                    <a href="{{ route('rrhh.shiftManag.index', ['orgunitFilter' => $actuallyOrgUnit->id,'turnFilter' => $actuallyShift->id,'monthYearFilter' => $actuallyYear . '-' . intval($actuallyMonth) - 1]) }}"
                        class="btn btn-sm btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Anterior</span>
                    </a>
                    <a href="{{ route('rrhh.shiftManag.index', ['orgunitFilter' => $actuallyOrgUnit->id,'turnFilter' => $actuallyShift->id,'monthYearFilter' => $actuallyYear . '-' . intval($actuallyMonth) + 1]) }}"
                        class="btn btn-sm btn-secondary btn-icon-split">
                        <span class="text">Siguiente</span>
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </a>
                    <br>
                    <br>
                    <h6>Leyenda:</h6>
                    @for ($i = 1; $i < sizeof($shiftStatus) + 1; $i++)
                        <span class="badge badge-secondary"
                            style="background-color:#{{ $colorsRgb[$i] }}">{{ ucfirst($shiftStatus[$i]) }}</span>
                    @endfor
                    <br>
                    <i class="	far fa-calendar-check"></i> Turno Confirmado
                    <i class="	far fa-calendar-times"></i> Turno Cerrado
                </div>
            </div>
            <table class="table table-sm table-bordered datatable">
                <thead>
                    <tr class="bg-gray-600 text-gray-100 text-center">
                        <th>Personal</th>
                        @for ($i = 1; $i <= $days; $i++)
                            @php
                                $dateFiltered = \Carbon\Carbon::createFromFormat('Y-m-d', $actuallyYear . '-' . $actuallyMonth . '-' . $i, 'Europe/London');
                            @endphp
                            <th
                                style="color:{{ $dateFiltered->isWeekend()? 'red': (sizeof($holidays->where('date', $actuallyYear . '-' . $actuallyMonth . '-' . $i)) > 0? 'red': 'white') }}">
                                <p style="font-size: 10px">{{ $i }}</p>
                            </th>
                        @endfor
                        <th>
                            <i class="fas fa-trash"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <div>
                        @livewire('rrhh.list-of-shifts',['actuallyYear'=>$actuallyYear,
                        'actuallyMonth'=>$actuallyMonth,'days'=>$days,'actuallyOrgUnit'=>$actuallyOrgUnit,'actuallyDay'=>$actuallyDay,'actuallyShift'=>$actuallyShift,'position'=>$position])
                    </div>
                </tbody>
            </table>
        </div>
    </div>

    {{-- @livewire("rrhh.modal-edit-shift-user-day",['monthYearFilter'=>$actuallyYear."-".$actuallyMonth,'actuallyShift'=>$actuallyShift->id,'actuallyOrgUnit'=>$actuallyOrgUnit]) --}}

@endsection

@section('custom_js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "order": [0, "asc"],
                "pageLength": 100,
                "paging": false,
                fixedHeader: true,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel"></i>',
                    className: 'btn btn-outline-success float-right',
                    messageTop: '{{ $actuallyOrgUnit->name }} - {{ $months[$actuallyMonth] }} {{ $actuallyYear }} - {{ $actuallyShift->name }} - {{ $position }}',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button');
                    }
                }],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    //"info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                    "info": "_TOTAL_ Registros Encontrados",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                    "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

        });
    </script>
@endsection
