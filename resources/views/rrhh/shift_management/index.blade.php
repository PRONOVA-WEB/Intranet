@extends('layouts.app')

@section('title', 'Gestion de Turnos')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
@section('content')

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

    .bless {border: none !important;}
    .br {border-right: solid 1px #454d55 !important;}
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
        padding: 0!important;
    }

    .table th, .table td {padding: 0.5rem !important;}

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
    .bg-red {background-color: #ff5133;}
    .bg-green {background-color: #00e63d;}
    .bg-purple {background-color: #d57aff;}
    .bg-red, .bg-green, .bg-purple {color: white;}


    .turn-selected {
        background: #ff0000;
        color: #fff;
        padding: 3px 15px;
        border-radius: 50%;

    }
    .only-icon {
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
    }

    .btnShiftDay:hover {
        opacity: 0.5;
        filter:  alpha(opacity=50);
    }

    .btn-light {
        border: 1px solid #ced4da;
    }
     td {
        overflow:hidden;
    }
    .cellbutton {
        width: 30px;
       font-size: 13px;
    }
    .btn-full {
        display: block;
        width: 100%;
        height: 100%;
        margin:-1000px;
        padding: 1000px;
        font-weight: bold;
    }
  .deleteButton {
    color: red;
  }
  .deleteButton:hover {
        opacity: 0.5;
        filter:  alpha(opacity=50);
  }
</style>


<!--Menu de Filtros  -->

@include("rrhh.shift_management.tabs", array('actuallyMenu' => 'indexTab'))
<!-- TODO: Que hace este div? -->
<div id="shiftapp">

    <div class="row mb-3 mt-2">
        <div class="col-md-12">
            <h3> Gestión de Turnos</h3>
        </div>
    </div>


    <form method="get" action="{{ route('rrhh.shiftManag.index') }}" >
        <!-- Menu de Filtros  -->
        <div class="form-row">
            <div class="form-group col-md-7" >
                <label for="for_name">Unidad organizacional</label>
                <select class="form-control selectpicker"  id="for_orgunitFilter" name="orgunitFilter" data-live-search="true" required
                            data-size="5">
                        @foreach($ouRoots as $ouRoot)
                            @if($ouRoot->name != 'Externos')
                                <option value="{{ $ouRoot->id }}"  {{($ouRoot->id==$actuallyOrgUnit->id)?'selected':''}}>
                                {{($ouRoot->id ?? '')}}-{{ $ouRoot->name }}
                                </option>
                                @foreach($ouRoot->childs as $child_level_1)

                                    <option value="{{ $child_level_1->id }}" {{($child_level_1->id==$actuallyOrgUnit->id)?'selected':''}}>
                                        &nbsp;&nbsp;&nbsp;
                                        {{($child_level_1->id ?? '')}}-{{ $child_level_1->name }}
                                    </option>
                                    @foreach($child_level_1->childs as $child_level_2)
                                        <option value="{{ $child_level_2->id }}" {{($child_level_2->id==$actuallyOrgUnit->id)?'selected':''}}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{($child_level_2->id ?? '')}}-{{ $child_level_2->name }}
                                        </option>
                                        @foreach($child_level_2->childs as $child_level_3)
                                            <option value="{{ $child_level_3->id }}" {{($child_level_3->id==$actuallyOrgUnit->id)?'selected':''}}>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                {{($child_level_3->id ?? '')}}-{{ $child_level_3->name }}
                                            </option>
                                            @foreach($child_level_3->childs as $child_level_4)
                                                <option value="{{ $child_level_4->id }}" {{($child_level_4->id==$actuallyOrgUnit->id)?'selected':''}}>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    {{($child_level_4->id ?? '')}}-{{ $child_level_4->name }}
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
                <label for="for_name" class="input-group-addon">Series</label>
                <select class="form-control" id="for_turnFilter" name="turnFilter">
                    {{-- <option value="0">0 - Todas</option> --}}
                    @php
                        $index = 0;
                    @endphp
                    @foreach($sTypes as $st)
                        @foreach($actuallyShiftMonthsList  as $key =>  $shiftMonth)
                            @foreach($shiftMonth as $sMonth)
                                @if($sMonth->shift_type_id == $st->id && $sMonth->user_id == auth()->user()->id && $sMonth->month == $actuallyMonth)

                                    <option value="{{$st->id}}" {{($st->id==$actuallyShift->id)?'selected':''}}>{{$index}} - {{$st->name}}</option>
                                    {{--json_encode($sMonth)--}}
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
                <input type="month" class="form-control" name="monthYearFilter" value="{{ $actuallyYear."-".$actuallyMonth }}">
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

        <input hidden name="dateFrom" value="{{$actuallyYear}}-{{$actuallyMonth}}-01">
        <input hidden name="dateUp" value="{{$actuallyYear}}-{{$actuallyMonth}}-{{$days}}">
        <input hidden name="shiftId" value="{{$actuallyShift->id}}">
        <input hidden name="orgUnitId" value="{{$actuallyOrgUnit->id}}">


        <div class="form-row">
            <div class="col-md-6">
                <label>Personal de "{{$actuallyOrgUnit->name}}"</label>
                <select class="selectpicker form-control"  data-live-search="true" name="slcStaff" required>
                    <option value=""> - </option>
                    @foreach($staff as $user)
                        <option value="{{$user->id}}">
                            {{$user->runFormat() }} - {{ $user->fullName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <label>Inicio</label>
                <select class="form-control" name="initialSerie">
                @if(isset($actuallyShift->day_series))
                    @php $currentSeries =  explode(",", $actuallyShift->day_series); @endphp
                    @for(  $i=0;$i< sizeof($currentSeries);$i++  )

                       @if($currentSeries[$i]!="")
                            <option value="{{$i}}">{{intval($i+1)}} - {{$currentSeries[$i]}}</option>
                        @endif
                    @endfor
                 @endif
                </select>
            </div>
            <div class="col-md-2">
                <label>De</label>
                <input type="date" class="form-control" name="dateFromAssign"
                    value="{{$actuallyYear}}-{{$actuallyMonth}}-01">
            </div>
            <div class="col-md-2 ">
                <label>Hasta</label>
                <input type="date" class="form-control" name="dateUpAssign"
                    value="{{$actuallyYear}}-{{$actuallyMonth}}-{{$days}}">
            </div>
            <div class="col-md-1">
                <label>&nbsp;</label>
                <button class="btn btn-success form-control">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
        </div>

    </form>

    <h6>Leyenda:</h6>
    @for( $i = 1 ; $i < (sizeof($shiftStatus)+1); $i++ )
        <span class="badge badge-secondary" style="background-color:#{{$colorsRgb[$i]}}">{{ucfirst($shiftStatus[$i])}}</span>
    @endfor
    <br>
    <i class="	far fa-calendar-check"></i> Turno Confirmado
    <i class="	far fa-calendar-times"></i> Turno Cerrado
    <hr>
    <div class="row" style=" overflow: auto;white-space: nowrap;">
        <div class="col-md-12">
            @if($actuallyShift->id != 0)
                <table class="table table-sm table-bordered datatable">
                    <thead class="card-header">
                        <tr>
                            {{-- <th rowspan="2">Personal</th> --}}
                            <th class="calendar-day" colspan="{{$days}}">

                                <a href="{{route('rrhh.shiftManag.index',['orgunitFilter'=>$actuallyOrgUnit->id,'turnFilter'=>$actuallyShift->id,'monthYearFilter'=>$actuallyYear.'-'.intval($actuallyMonth)-1])}}" class="btn btn-sm btn-secondary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-arrow-left"></i>
                                    </span>
                                <span class="text">Anterior</span>
                                </a>

                                @foreach($months AS $index => $month)
                                    {{ ($index == $actuallyMonth )? $month : "" }}
                                @endforeach

                                {{$actuallyYear}}
                                -
                                {{$actuallyShift->name}}

                                <a href="{{route('rrhh.shiftManag.index',['orgunitFilter'=>$actuallyOrgUnit->id,'turnFilter'=>$actuallyShift->id,'monthYearFilter'=>$actuallyYear.'-'.intval($actuallyMonth)+1])}}" class="btn btn-sm btn-secondary btn-icon-split">
                                    <span class="text">Siguiente</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </a>
                            </th>
                        </tr>
                        <tr class="thead-dark">
                            <th>Personal</th>
                            @for($i = 1; $i <= $days; $i++)
                                @php
                                    $dateFiltered = \Carbon\Carbon::createFromFormat('Y-m-d',  $actuallyYear."-".$actuallyMonth."-".$i, 'Europe/London');
                                @endphp
                                <th class="brless dia"
                                    style="color:{{ ( ($dateFiltered->isWeekend() )?'red':( ( sizeof($holidays->where('date',$actuallyYear.'-'.$actuallyMonth.'-'.$i)) > 0 ) ? 'red':'white' ))}}" >
                                    <p style="font-size: 8px">{{$i}}</p>
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        <div>
                            @livewire('rrhh.list-of-shifts',['actuallyYear'=>$actuallyYear, 'actuallyMonth'=>$actuallyMonth,'days'=>$days,'actuallyOrgUnit'=>$actuallyOrgUnit,'actuallyOrgUnit'=>$actuallyOrgUnit,'actuallyDay'=>$actuallyDay,'actuallyShift'=>$actuallyShift])
                        </div>
                    </tbody>
                </table>
            @else
                @foreach($sTypes as $st)
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th rowspan="2">Personal</th>
                                <th class="calendar-day" colspan="{{$days}}">
                                    @foreach($months AS $index => $month)
                                        {{ ($index == $actuallyMonth )?$month:"" }}
                                    @endforeach

                                    {{$actuallyYear}}
                                    -
                                    {{$st->name}}
                                </th>
                            </tr>
                            <tr>
                                @for($i = 1; $i <= $days; $i++)
                                    @php
                                        $dateFiltered = \Carbon\Carbon::createFromFormat('Y-m-d',  $actuallyYear."-".$actuallyMonth."-".$i, 'Europe/London');
                                    @endphp

                                    <th class="brless dia"
                                        style="color:{{ ( ($dateFiltered->isWeekend() )?'red':( ($holidays->where('date',$dateFiltered)) ? 'red':'white')  )}}" >
                                       {{$i}}
                                    </th>
                                    <!-- <th class="brless dia">🌞</th> -->
                                    <!-- <th class="noche">🌒</th> -->
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @livewire('rrhh.list-of-shifts',["actuallyShift"=>$st])
                        </tbody>
                    </table>
                @endforeach
            @endif
        </div>
    </div>

</div>

@livewire("rrhh.modal-edit-shift-user-day")

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
                messageTop: '{{ $actuallyOrgUnit->name }} - {{ $months[$actuallyMonth] }} {{ $actuallyYear }} - {{ $actuallyShift->name }}',
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
