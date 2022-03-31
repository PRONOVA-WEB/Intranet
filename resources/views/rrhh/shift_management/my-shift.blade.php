@extends('layouts.app')

@section('title', 'Gestion de Turnos')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')
    <style type="text/css">
        .scroll {
            max-height: 200px;
            overflow-y: auto;
        }

    </style>
    <!--Menu de Filtros  -->

    <style type="text/css">
        :root {
            font-size: 16px;
        }

        .table {
            white-space: nowrap;
        }

        .table thead th {
            text-align: center;
            vertical-align: middle;
            border-bottom: none;
            border: none;
        }

        .brless {
            /* border-right: solid 1px transparent !important; */
        }

        .bless {
            border: none !important;
        }

        .br {
            border-right: solid 1px #454d55 !important;
        }

        .dia {
            opacity: 0.8;
        }

        .day {
            background-color: white;
            text-align: center;
        }

        .night {
            background-color: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-right-color: black !important;
        }

        .calendar-day {
            font-size: 2rem;
            text-align: center;
            padding: 0 !important;
        }

        .table th,
        .table td {
            padding: 0.5rem !important;
        }

        .borderBottom {
            border-bottom: solid 2px #454d55 !important;
        }

        .bbd {
            border-top: none;
            border-left: none;
            border-right: none;

        }

        .bbn {
            border-top: none !important;
            border-left: none;
            border-right: solid 1px #454d55;

        }

        .bg-red {
            background-color: #ff5133;
        }

        .bg-green {
            background-color: #00e63d;
        }

        .bg-purple {
            background-color: #d57aff;
        }

        .bg-red,
        .bg-green,
        .bg-purple {
            color: white;
        }


        .turn-selected {
            background: #ff0000;
            color: #fff;
            padding: 3px 15px;
            border-radius: 50%;

        }

        .only-icon {
            background-color: Transparent;
            background-repeat: no-repeat;
            border: none;
            cursor: pointer;
            overflow: hidden;
            outline: none;
        }

        .btnShiftDay:hover {
            opacity: 0.5;
            filter: alpha(opacity=50);
        }

        .btn-light {
            border: 1px solid #ced4da;
        }

        td {
            overflow: hidden;
        }

        .cellbutton {
            width: 30px;
            font-size: 13px;
        }

        .btn-full {
            display: block;
            width: 100%;
            height: 100%;
            margin: -1000px;
            padding: 1000px;
            font-weight: bold;
        }

        .deleteButton {
            color: red;
        }

        .deleteButton:hover {
            opacity: 0.5;
            filter: alpha(opacity=50);
        }

    </style>
    @include('rrhh.shift_management.tabs', ['actuallyMenu' => 'MyShiftTab'])

    <div>
        <div class="col-md-6">
            <h3> Mi Turno </h3>
        </div>
        <div class="scroll">
            @if ($myConfirmationEarrings && json_encode($myConfirmationEarrings) == '{}')

                <div class="alert alert-info">
                    <strong>Ninguna</strong> confirmación de día extra pendiente!.
                </div>
            @else
                {{-- json_encode($myConfirmationEarrings) --}}
                @foreach ($myConfirmationEarrings as $day)
                    <div class="card ">
                        <div class="card-body">
                            <h5 class="card-title">Día Agregado</h5>
                            <p class="card-text" style="margin-left: 101px">
                                <i>
                                    <i class="fa fa-user"></i> <i class="fa fa-arrow-right"></i>
                                    <i class="fa fa-user"></i>
                                    El usuario
                                    {{ $day->derived_from && $day->derived_from != '' ? $day->DerivatedShift->ShiftUser->user->id : '' }}
                                    te asigno el día {{ $day->day }}
                                    <b style="background-color: yellow;color:gray"> {{ $day->working_day }} </b> .
                                    @if (App\Models\Rrhh\ShiftUserDay::where('id', '<>', $day->id)->where('day', $day->day)->whereHas('ShiftUser', function ($q) {
        $q->where('user_id', Auth::user()->id);
    })->get())
                                        @php

                                            $dayInTheSame = App\Models\Rrhh\ShiftUserDay::where('day', $day->day)
                                                ->whereHas('ShiftUser', function ($q) {
                                                    $q->where('user_id', Auth::user()->id);
                                                })
                                                ->get();
                                            $dayInTheSame = $dayInTheSame[0];
                                        @endphp
                                        <i style="color:{{ $dayInTheSame->working_day == 'F' ? 'green' : 'red' }}"> Ese
                                            día tienes asignado {{ $dayInTheSame->working_day }} -
                                            {{ $tiposJornada[$dayInTheSame->working_day] }} </i>
                                    @else
                                        Ese día tienes asignado N/A
                                    @endif
                            </p>
                            </i>
                            <div class="pull-right">
                                <form action="{{ route('rrhh.shiftManag.myshift.confirmDay', [$day]) }}">
                                    @csrf
                                    <button class="btn btn-success ">Confirmar <i class="fa fa-check"></i></button>
                                </form>
                            </div>
                            <div class="pull-right">
                                <form action="{{ route('rrhh.shiftManag.myshift.rejectDay', [$day]) }}">
                                    @csrf
                                    <button class="btn btn-danger pull-right"><b>X</b> </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <br>
        <br>
        <form method="get" action="{{ route('rrhh.shiftManag.myshift') }}">
            <!-- Menu de Filtros  -->
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="for_name" class="input-group-addon">Series</label>
                    <select class="form-control" id="for_turnFilter" name="turnFilter">
                        @foreach ($sTypes as $st)
                            <option value="{{ $st->id }}" {{ $st->id == $actuallyShift->id ? 'selected' : '' }}>
                                {{ $loop->iteration }} - {{ $st->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="for_name">Fecha</label>
                    <input type="month" class="form-control" name="monthYearFilter"
                        value="{{ $actuallyYear . '-' . $actuallyMonth }}">
                </div>

                <div class="form-group col-md-1">
                    <label for="for_submit">&nbsp;</label>
                    <button type="submit" class="btn btn-primary form-control">Filtrar</button>
                </div>

            </div>

        </form>
        <hr>
        <table class="table table-sm table-bordered datatable">
            <thead class="card-header">
                <tr>
                    <th class="calendar-day" colspan="{{ $days }}">

                        <a href="{{ route('rrhh.shiftManag.myshift', ['turnFilter' => $actuallyShift->id,'monthYearFilter' => $actuallyYear . '-' . intval($actuallyMonth) - 1]) }}"
                            class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Anterior</span>
                        </a>

                        @foreach ($months as $index => $month)
                            {{ $index == $actuallyMonth ? $month : '' }}
                        @endforeach

                        {{ $actuallyYear }}
                        -
                        {{ $actuallyShift->name }}

                        <a href="{{ route('rrhh.shiftManag.myshift', ['turnFilter' => $actuallyShift->id,'monthYearFilter' => $actuallyYear . '-' . intval($actuallyMonth) + 1]) }}"
                            class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="text">Siguiente</span>
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>Personal</th>
                    @for ($i = 1; $i <= $days; $i++)
                        @php
                            $dateFiltered = \Carbon\Carbon::createFromFormat('Y-m-d', $actuallyYear . '-' . $actuallyMonth . '-' . $i, 'Europe/London');
                        @endphp
                        <th class="brless dia"
                            style="color:{{ $dateFiltered->isWeekend()? 'red': (sizeof($holidays->where('date', $actuallyYear . '-' . $actuallyMonth . '-' . $i)) > 0? 'red': 'white') }}">
                            <p style="font-size: 8px">{{ $i }}</p>
                        </th>
                        <!-- <th class="brless dia">🌞</th> -->
                        <!-- <th class="noche">🌒</th> -->
                    @endfor
                </tr>
            </thead>
            <tbody>
                <div>
                    @livewire('rrhh.list-of-shifts', ["staffInShift"=>$myShifts,'actuallyYear'=>$actuallyYear,
                    'actuallyMonth'=>$actuallyMonth,'days'=>$days,'actuallyOrgUnit'=>$actuallyOrgUnit,'actuallyShift'=>$actuallyShift])
                </div>
            </tbody>
        </table>
    </div>

@endsection
@livewire("rrhh.modal-edit-shift-user-day")

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
                messageTop: '{{ Auth()->user()->full_name }} {{ Auth()->user()->runFormat() }} - {{ $months[$actuallyMonth] }} {{ $actuallyYear }} - {{ $actuallyShift->name }}',
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
