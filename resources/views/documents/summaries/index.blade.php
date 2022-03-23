@extends('layouts.app')

@section('title', 'Listado de sumarios')

@section('content')

@include('documents.summaries.partials.nav')

<div class="mb-3">
	<a class="btn btn-primary"
		href="{{ route('documents.summaries.create') }}">
		<i class="fas fa-shopping-cart"></i> Nuevo sumario
	</a>

	<button type="button" class="btn btn-outline-primary" onclick="#">
		<i class="fas fa-download"></i>
	</button>
</div>

<h3>Sumarios activos</h3>

@php
$now = Carbon\Carbon::now()
@endphp

<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nro.Res.</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Fiscal</th>
            <th>Estado Actual</th>
						<th>Usuario involucrado</th>
						<th>T. desde último evento</th>
						<th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($open_summaries as $summary)
					@if($summary->events->last()->event_date->diff($now)->days > $summary->events->last()->granted_days)
	        	<tr class="table-danger">
					@else
						<tr>
					@endif
	            <td>{{$summary->id}}</td>
	            <td>{{$summary->resolution_number}}</td>
	            <td>{{$summary->summary_date}}</td>
	            <td>{{$summary->type}}</td>
	            <td>{{$summary->fiscal->user->getFullNameAttribute()}}</td>
	            <td>{{$summary->events->last()->status->name}}</td>
							<td>{{$summary->events->last()->creator->getFullNameAttribute()}}</td>
							<td>{{$summary->events->last()->event_date->diffForHumans()}}</td>
	            <td><a href="{{route('documents.summaries.edit',$summary)}}"><i class="fas fa-edit"></i></a></td>
	        </tr>
				@endforeach
    </tbody>
</table>

<h3>Sumarios finalizados</h3>



<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nro.Res</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Fiscal</th>
            <th>Estado Actual</th>
						<th>Dias desde último evento</th>
            <td></td>
        </tr>
    </thead>
    <tbody>
			@foreach($closed_summaries as $summary)
				<tr>
					<td>{{$summary->id}}</td>
					<td>{{$summary->resolution_number}}</td>
					<td>{{$summary->summary_date}}</td>
					<td>{{$summary->type}}</td>
					<td>{{$summary->fiscal->user->getFullNameAttribute()}}</td>
					<td>{{$summary->events->last()->status->name}}</td>
					<td>{{$summary->events->last()->creator->getFullNameAttribute()}}</td>
					<td>{{$summary->events->last()->event_date->diffForHumans()}}</td>
					<td></td>
					<td><a href="{{route('documents.summaries.edit',$summary)}}"><i class="fas fa-edit"></i></a></td>
				</tr>
			@endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

@endsection
