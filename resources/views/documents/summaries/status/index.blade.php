@extends('layouts.app')

@section('title', 'Listado de estados')

@section('content')

@include('documents.summaries.partials.nav')

<div class="mb-3">
	<a class="btn btn-primary"
		href="{{ route('documents.summaries.status.create') }}">
		<i class="fas fa-shopping-cart"></i> Nuevo Estado
	</a>

	<button type="button" class="btn btn-outline-primary" onclick="#">
		<i class="fas fa-download"></i>
	</button>
</div>

<h3>Estados</h3>

<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
						<th>Días otorgados</th>
						<th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($summaryStatus as $status)
	        <tr>
	            <td>{{$status->id}}</td>
							<td>{{$status->name}}</td>
							<td>{{$status->granted_days}}</td>
							<td></td>
	        </tr>
				@endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
