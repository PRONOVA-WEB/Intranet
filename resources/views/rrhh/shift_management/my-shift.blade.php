@extends('layouts.app')

@section('title', 'Gestion de Turnos')

@section('custom_css')
<style>
.table td, .table th {
    vertical-align: middle !important;
}
</style>
@endsection

@section('content')

    @include('rrhh.shift_management.tabs', ['actuallyMenu' => 'MyShiftTab'])

    <div class="row mb-3 mt-2">
        <div class="col-md-12">
            <h3> Mi turno</h3>
        </div>
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
    <h4>
        @foreach ($months as $index => $month)
        {{ $index == $actuallyMonth ? $month : '' }}
        @endforeach

        {{ $actuallyYear }}
        -
        {{ $actuallyShift->name }}
    </h4>
    <table class="table table-sm table-bordered datatable">
        <thead>
            <tr class="bg-gray-600 text-gray-100 text-center">
                <th>Personal</th>
                @for ($i = 1; $i <= $days; $i++)
                    @php
                        $dateFiltered = \Carbon\Carbon::createFromFormat('Y-m-d', $actuallyYear . '-' . $actuallyMonth . '-' . $i, 'Europe/London');
                    @endphp
                    <th style="color:{{ $dateFiltered->isWeekend()? 'red': (sizeof($holidays->where('date', $actuallyYear . '-' . $actuallyMonth . '-' . $i)) > 0? 'red': 'white') }}">
                        <p style="font-size: 10px">{{ $i }}</p>
                    </th>
                @endfor
                <th><i class="fas fa-trash"></i></th>
            </tr>
        </thead>
        <tbody>
            <div>
                @livewire('rrhh.list-of-shifts', ["staffInShift"=>$myShifts,'actuallyYear'=>$actuallyYear,
                'actuallyMonth'=>$actuallyMonth,'days'=>$days,'actuallyOrgUnit'=>$actuallyOrgUnit,'actuallyShift'=>$actuallyShift])
            </div>
        </tbody>
    </table>

@endsection
{{-- @livewire("rrhh.modal-edit-shift-user-day") --}}

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
