@extends('layouts.app')

@section('title', 'Historial de documentos')

@section('content')

<h3>Sumarios activos</h3>

<div class="mb-3">
	<a class="btn btn-primary"
		href="{{ route('documents.summaries.create') }}">
		<i class="fas fa-shopping-cart"></i> Nuevo sumario
	</a>

	<button type="button" class="btn btn-outline-primary" onclick="#">
		<i class="fas fa-download"></i>
	</button>
</div>

<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nro.Res</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Fiscal</th>
            <th>Estado</th>
						<th>Dias desde último evento</th>
						<th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($summaries as $summary)
	        <tr>
	            <td>{{$summary->id}}</td>
	            <td>{{$summary->resolution_number}}</td>
	            <td>{{$summary->summary_date}}</td>
	            <td>{{$summary->type}}</td>
	            <td>{{$summary->fiscal}}</td>
	            <td>En proceso (falta)</td>
							<td>3 (falta)</td>
	            <td><a class="delete"><i class="fas fa-edit"></i></a></td>
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
            <th>Estado</th>
						<th>Dias desde último evento</th>
            <td></td>
        </tr>
    </thead>
    <tbody>
			@foreach($summaries as $summary)
				<tr>
						<td>{{$summary->id}}</td>
						<td>{{$summary->resolution_number}}</td>
						<td>{{$summary->summary_date}}</td>
						<td>{{$summary->type}}</td>
						<td>{{$summary->fiscal}}</td>
						<td>En proceso (falta)</td>
						<td>3 (falta)</td>
						<td><a class="delete"><i class="fas fa-edit"></i></a></td>
				</tr>
			@endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

@endsection
