@extends('layouts.app')

@section('title', 'Listado de Ingresos')

@section('content')

@include('pharmacies.nav')

<h3>Listado de Ingresos</h3>

<div class="mb-3">
	@canany(['Pharmacy: create'])
	<a class="btn btn-primary"
		href="{{ route('pharmacies.products.receiving.create') }}">
		<i class="fas fa-plus-circle"></i> Nuevo ingreso</a>
	@endcanany

	<button type="button" class="btn btn-outline-primary"
		onclick="$('#tabla_receiving').tblToExcel();">
		<i class="fas fa-download"></i>
	</button>
</div>


<div class="table-responsive">
	<table class="table table-striped table-sm" id="tabla_receiving">
		<thead>
			<tr>
				<th scope="col">id</th>
				<th scope="col">Fecha</th>
				<th scope="col">Establecimiento</th>
				<th scope="col">Notas</th>
				<th scope="col">Accion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($receivings as $key => $receiving)
			<tr>
				<td>{{ $receiving->id }}</td>
        <td>{{ Carbon\Carbon::parse($receiving->date)->format('d/m/Y')}}</td>
        <td>{{ $receiving->establishment->name }}</td>
        <td>{{ $receiving->notes }}</td>
		<td  nowrap>
				@can('Pharmacy: edit_delete')
					<a href="{{ route('pharmacies.products.receiving.edit', $receiving) }}" class="btn btn-outline-secondary btn-sm">
					<span class="fas fa-edit" aria-hidden="true"></span></a>

					<form method="POST" action="{{ route('pharmacies.products.receiving.destroy', $receiving) }}" class="d-inline">
			            @csrf
			            @method('DELETE')
						<button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Está seguro de eliminar la información?');">
							<span class="fas fa-trash-alt" aria-hidden="true"></span>
						</button>
					</form>
					@endcan

					<a href="{{ route('pharmacies.products.receiving.record', $receiving) }}"
						class="btn btn-outline-secondary btn-sm" target="_blank">
					<span class="fas fa-file" aria-hidden="true"></span></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

{{-- {{ $receivings->links() }} --}}

@endsection

@section('custom_js')
<script src="{{ asset('js/jquery.tableToExcel.js') }}"></script>
@endsection
