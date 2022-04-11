@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('custom_css')
<style>
	.tooltip-wrapper {
	display: inline-block; /* display: block works as well */
	}

	.tooltip-wrapper .btn[disabled] {
	/* don't let button block mouse events from reaching wrapper */
	pointer-events: none;
	}

	.tooltip-wrapper.disabled {
	/* OPTIONAL pointer-events setting above blocks cursor setting, so set it here */
	cursor: not-allowed;
	}
    .dataTables_filter {
        float:right;
    }
</style>
@endsection

@section('content')
<div class="row">
		<h3>Usuarios
			@can('Users: create')
				<a href="{{ route('rrhh.users.create') }}" class="btn btn-primary">Crear</a>
			@endcan
		</h3>
</div>
<hr>
<table class="table table-responsive-xl table-striped table-sm datatable">
	<thead class="thead-dark">
		<tr>
			<th scope="col">RUN</th>
			<th scope="col">Nombre</th>
			<th scope="col">Unidad Organizacional</th>
			<th scope="col">Cargo/Funcion</th>
			<th scope="col">Accion</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<th scope="row" nowrap>{{ $user->runFormat() }}</td>
			<td nowrap>{{ $user->fullName }} {{ trashed($user) }}</td>
			<td class="small">{{ @$user->organizationalunit->name ?: ''}}</td>
			<td class="small">{{ $user->position }}</td>
			<td nowrap>
				@unless($user->trashed())
				@can('Users: edit')
					<a href="{{ route('rrhh.users.edit',$user->id) }}" class="btn btn-outline-primary">
					<span class="fas fa-edit" aria-hidden="true"></span></a>
					@if(!$user->hasVerifiedEmail())
						@if($user->email_personal)
						<form class="d-inline" method="POST" action="{{ route('verification.resend', $user->id) }}">
							@csrf
							<div class="tooltip-wrapper" data-title="Verificar correo electrónico personal">
							<button class="btn btn-outline-primary"><span class="fas fa-user-check" aria-hidden="true"></span></button>
							</div>
						</form>
						@else
						<div class="tooltip-wrapper disabled" data-title="No existe registro de correo electrónico personal para ser verificada">
							<button class="btn btn-outline-primary" disabled><span class="fas fa-user-check" aria-hidden="true"></span></button>
						</div>
						@endif
					@else
						<div class="tooltip-wrapper disabled" data-title="Correo electrónico personal verificada">
							<button class="btn btn-outline-success" disabled><span class="fas fa-user-check" aria-hidden="true"></span></button>
						</div>
					@endif
				@endcan

				@role('superuser')
				<a href="{{ route('rrhh.users.switch', $user->id) }}" class="btn btn-outline-warning">
				<span class="fas fa-redo" aria-hidden="true"></span></a>
				@endrole
				@endunless
			</td>
		</tr>
		@endforeach
	</tbody>

</table>

@endsection

@section('custom_js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
$(function() {
	$('.tooltip-wrapper').tooltip({position: "bottom"});
});
$(document).ready(function() {
    $('.datatable').DataTable({
        "order": [2, "asc"],
        "pageLength": 25,
        "paging": true,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
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
