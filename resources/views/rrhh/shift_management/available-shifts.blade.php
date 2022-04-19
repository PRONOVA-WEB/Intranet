@extends('layouts.app')

@section('title', 'Gestion de Turnos')

@section('content')

	@include("rrhh.shift_management.tabs", array('actuallyMenu' => 'availableShifts'))

    <div class="row mb-3 mt-2">
        <div class="col-md-12">
            <h3> Turnos Disponibles</h3>
        </div>
    </div>
    <form method="post" action="{{ route('rrhh.shiftManag.availableShifts') }}" >
        @csrf
        {{ method_field('post') }}  <!-- equivalente a: @method('POST') -->

        <!-- Menu de Filtros  -->
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="for_name">Fecha</label>
                <input type="month" class="form-control" name="monthYearFilter"
                    value="{{ $actuallyYear . '-' . $actuallyMonth }}">
            </div>
            <div class="form-group col-md-1">
                <label for="for_submit">&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control">Filtrar  </button>
            </div>
        </div>
    </form>
    <h5><b>Disponibles:</b></h5>
	<br>
	@if( sizeof ( $availableDays ) < 1 )
		<div class="alert alert-primary" role="alert">
			Sin días disponibles para solicitar
		</div>
	@endif
        @php
            $i=0;
        @endphp
        @foreach($availableDays as $aDay)
        @if(count($aDay->Solicitudes) > 0 && $aDay->Solicitudes->last()->status == 'confirmado')

        @else
        @php
        $i++;
        @endphp
        @php
            $dayFormated = \Carbon\Carbon::createFromFormat('Y-m-d', $aDay->day, 'Europe/London');
        @endphp
        @php
            $dayWithCarbon = \Carbon\Carbon::createFromFormat('Y-m-d',  $aDay->day, 'Europe/London');
        @endphp
        <li class="list-group-item ">
        <div class="row row-striped">
            <div class="col-2 text-right">
                <h1 class="display-4"><span class="badge badge-secondary">{{ $dayWithCarbon->day }}</span></h1>
                <h2>{{ strtoupper ( substr ( $months [ $dayWithCarbon->month ], 0, 3 ) ) }} </h2>
            </div>
            <div class="col-10">
                <h3 class="text-uppercase"><strong>Jornada:

                    @if ( substr( $aDay->working_day,0, 1) != "+" )

                        {{$aDay->working_day }}- {{ $tiposJornada[ $aDay->working_day ] }}

                    @elseif( substr( $aDay->working_day,0, 1) == "+" )

                        {{$aDay->working_day}}

                    @endif
                </strong></h3>

                <ul class="list-inline">

                    <li class="list-inline-item"><i class="fas fa-calendar" aria-hidden="true"></i>  {{ $weekMap [ $dayWithCarbon->dayOfWeek ] }}</li>
                    <li class="list-inline-item"><i class="fas fa-clock" aria-hidden="true"></i> {{ $timePerDay [ $aDay->working_day  ] [ "from" ]}} - {{ $timePerDay [ $aDay->working_day  ] [ "to" ]}} </li>
                    <li class="list-inline-item"><i class="fa fa-location-arrow info" aria-hidden="true"></i> Hospital General</li>

                </ul>

                <b>ID:<small># {{$aDay->id }}</small></b><br>
                <b>Propietario</b>
                <p>{{$aDay->ShiftUser->user->runFormat()}} -  {{$aDay->ShiftUser->user->getFullNameAttribute()}} </p>
                <b>Comentario</b>
                <p>{{$aDay->commentary}}</p>

                @if(count($aDay->Solicitudes) > 0 && $aDay->Solicitudes->last()->status == 'pendiente')
                <b>Solicitud pendiente de aprobación</b>
                @else
                <form method="post" action="{{ route('rrhh.shiftManag.availableShifts.applyfor') }}" >
                    @csrf
                    {{ method_field('post') }}
                    <input type="hidden" name="idShiftUserDay" value="{{$aDay->id}}">
                    <button class="btn btn-success">Solicitar</button>
                    <small> <i class="fa fa-user"></i> {{ count( $aDay->Solicitudes ) }} Solicitudes.</small>
                </form>
                @endif

            </div>
        </div>
        </li>
        @endif
        @endforeach
        @if( $i == 0 &&   sizeof (  $availableDays ) > 0 )
            <div class="alert alert-primary" role="alert">
                Sin días disponibles para solicitar
            </div>
        @endif
	<br>
	<h5><b>Mis solicitudes:</b></h5>
	<br>
	@if( count ( $misSolicitudes ) < 0)
		<div class="alert alert-primary" role="alert">
			Sin registro de solicitudes realizadas este mes
		</div>
	@endif
    <div class="row">
        @foreach( $misSolicitudes as $solicitud)
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ID: # {{$solicitud->id}}</h6>
                </div>
                <div class="card-body">
                    <b>Propietario</b>
                    <p>{{$solicitud->ShiftUserDay->ShiftUser->user->runFormat()}} -  {{$solicitud->ShiftUserDay->ShiftUser->user->getFullNameAttribute()}} </p>
                    <b>Día</b>
                    <p> {{ dateCustomFormat($solicitud->ShiftUserDay->day) }}, Jornada: {{ $solicitud->ShiftUserDay->working_day}} - {{ $tiposJornada [ $solicitud->ShiftUserDay->working_day ] }}</p>
                    <b>Solicitud</b>
                    <p>Solicitado por {{$solicitud->user->runFormat()}} -  {{$solicitud->user->getFullNameAttribute()}} </p>
                    <p> Solicitado el {{dateCustomFormatHms($solicitud->created_at)}}</p>
                    <b>Estado</b>
                    <p style="color:{{$solicitud->statusColor()}}"> {{ strtoupper( $solicitud->status ) }}</p>
                    @if($solicitud->status == "pendiente")
                        <form  method="post" action="{{ route('rrhh.shiftManag.availableShifts.cancelRequest') }}" >
                            @csrf
                            {{ method_field('post') }}
                            <input type="hidden" name="solicitudId" value="{{$solicitud->id}}">
                            <button class="btn btn-danger">Cancelar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
<!-- x terminar -->
	<h5><b>Solicitudes pendientes de aprobar:</b></h5>
    @if( count ( $solicitudesPorAprobar ) < 1)
        <div class="alert alert-primary" role="alert">
            Sin registro de solicitudes pendientes de aprobar
        </div>
    @endif
    <div class="row">
        @foreach($solicitudesPorAprobar as $solPending)
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ID: # {{$solPending->id}}</h6>
                </div>
                <div class="card-body">
                <br>
                <b>Día</b>
                <p> {{ dateCustomFormat($solPending->ShiftUserDay->day) }}, Jornada: {{ $solPending->ShiftUserDay->working_day}} - {{ $tiposJornada [ $solPending->ShiftUserDay->working_day ] }}</p>
                <b>Solicitud</b>
                <p>Solicitado por {{$solPending->user->runFormat()}} -  {{$solPending->user->getFullNameAttribute()}} </p>
                <p> Solicitado el {{dateCustomFormatHms($solPending->created_at)}}</p>
                <b>Estado</b>
                <p style="color:{{$solPending->statusColor()}}"> {{ strtoupper( $solPending->status ) }}</p>
                <form  method="post" action="{{route('rrhh.shiftManag.availableShifts.approvalRequest') }}" >
                    @csrf
                    {{ method_field('post') }}
                    <input type="hidden" name="solicitudId" value="{{ $solPending->id }}">
                    <button class="btn btn-success">Aprobar <i class="fa fa-check"></i></button>
                </form>
                <br>
                <form  method="post" action="{{route('rrhh.shiftManag.availableShifts.rejectRequest') }}" >
                    @csrf
                    {{ method_field('post') }}
                    <input type="hidden" name="solicitudId" value="{{ $solPending->id }}">
                    <button class="btn btn-danger">Rechazar <i class="fa fa-times"></i></button>
                </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

