@extends('layouts.app')

@section('title', 'Gestion de Turnos')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
    <style>
        #chartpeoplecant {
            width: 100%;
            height: 500px;
        }

        .tableFixHead {
            overflow: auto;
            height: 300px;
        }

        .tableFixHead thead th {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        /* Just common table stuff. Really. */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px 16px;
        }

        th {
            background: #eee;
        }

    </style>
    @include('rrhh.shift_management.tabs', ['actuallyMenu' => 'reports'])

    <div class="row mb-3 mt-2">
        <div class="col-md-12">
            <h3> Dashboard</h3>
        </div>
    </div>
    <form method="post" action="{{ route('rrhh.shiftManag.shiftReports') }}">
        @csrf
        <!-- Menu de Filtros  -->
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="for_name">Unidad organizacional</label>
                <select class="form-control selectpicker" id="for_orgunitFilter" name="orgunitFilter" data-live-search="true"
                    required data-size="5">
                    <option value="0">0 - Todos</option>
                    @foreach ($ouRoots as $ouRoot)
                        @if ($ouRoot->name != 'Externos')
                            <option value="{{ $ouRoot->id }}" {{ $ouRoot->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
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
            <div class="form-group col-md-2">
                <label for="for_name" class="input-group-addon">Jornada</label>
                <select class="form-control" id="for_journalType" name="journalType">
                    <option value="0">0 - Todas</option>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($tiposJornada as $index => $jt)
                        <option value="{{ $index }}" {{ $index == $actuallyJournalType ? 'selected' : '' }}>
                            {{ $loop->iteration }} - {{ $jt }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="for_name" class="input-group-addon">Estado</label>
                <select class="form-control" id="for_dayStatus" name="dayStatus">

                    <option value="0">0 - Todos</option>
                    @foreach ($shiftStatus as $index => $ss)
                        <option value="{{ $index }}" {{ $index == $actuallyDayStatus ? 'selected' : '' }}>
                            {{ $index }} - {{ ucfirst($ss) }} </option>
                    @endforeach
                    <!-- <option value="99">99 - Solo Turno Personalizado</option> -->
                </select>
            </div>

            <div class="form-group col-md-1">
                <label for="for_name">Desde</label>

                <input type="date" class="form-control" name="datefrom" value="{{ $datefrom }}">
            </div>

            <div class="form-group col-md-1">
                <label for="for_name">Hasta</label>

                <input type="date" class="form-control" name="dateto" value="{{ $dateto }}">

            </div>

            <div class="form-group col-md-1">
                <label for="for_submit">&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control">Filtrar</button>
            </div>

        </div>
    </form>

    <table class="table table-sm table-bordered datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Rut</th>
                <th>Nombre</th>
                <th>U. Organizacional</th>
                <th>Dia</th>

                <th>Jornada</th>
                <th>Estatus Día</th>
                <th>Remplazado con</th>
                <th>Estatus Turno</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($reportResult as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->ShiftUser->user->runFormat() }}</td>
                    <td>{{ $r->ShiftUser->user->getFullNameAttribute() }}</td>
                    <td>{{ isset($r->ShiftUser->user->organizationalUnit) &&$r->ShiftUser->user->organizationalUnit != '' &&isset($r->ShiftUser->user->organizationalUnit->name)? $r->ShiftUser->user->organizationalUnit->name: '' }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($r->day)->format('d-m-Y') }}</td>
                    @if (substr($r->working_day, 0, 1) != '+')
                        <td>{{ $r->working_day }} - {{ strtoupper($tiposJornada[$r->working_day]) }}</td>
                    @elseif(substr($r->working_day, 0, 1) == '+')
                        <td> <i class="fa fa-clock-o"></i> {{ $r->working_day }}</td>
                    @else
                        <td> <i class="fas fa-spinner fa-pulse"></i></td>
                    @endif

                    @php
                        $dayF = \Carbon\Carbon::createFromFormat('Y-m-d', $r->day, 'Europe/London');
                    @endphp
                    <td>{{ ucfirst($shiftStatus[$r->status]) }}
                    </td>
                    <td>{{ $r->derived_from != '' && isset($r->DerivatedShift)? $r->DerivatedShift->ShiftUser->user->runFormat() .' ' .$r->DerivatedShift->ShiftUser->user->getFullNameAttribute(): '--' }}
                    </td>
                    <td>
                        {{ !isset($r->closeStatus->status) ? '--': (($r->closeStatus->status < 2) ? 'Confirmado': 'Cerrado') }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
@section('custom_js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {

        $('.datatable').DataTable({
        "order": [ 0, "asc" ],
        "pageLength": 100,
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel"></i>',
                className: 'btn btn-info float-right',
                messageTop: '{{ $actuallyOrgUnit->name }} - Reporte de Turnos - '+$("[name='datefrom']").val()+ ' a '+$("[name='dateto']").val(),
                init: function(api, node, config) {
                    $(node).removeClass('dt-button');
                }
            }
        ],
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
