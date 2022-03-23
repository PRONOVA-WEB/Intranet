@extends('layouts.app')

@section('title', 'Listado de sumarios')

@section('content')

@include('documents.summaries.partials.nav')

<div class="mb-3">
	<a class="btn btn-primary"
		href="{{ route('documents.summaries.fiscals.create') }}">
		<i class="fas fa-shopping-cart"></i> Nuevo Fiscal
	</a>

	<button type="button" class="btn btn-outline-primary" onclick="#">
		<i class="fas fa-download"></i>
	</button>
</div>

<h3>Fiscales</h3>

<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
						<th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($fiscals as $fiscal)
	        <tr>
	            <td>{{$fiscal->user->runNotFormat()}}</td>
							<td>{{$fiscal->user->getFullNameAttribute()}}</td>
							<td>
								<form method="POST" class="form-horizontal" action="{{ route('documents.summaries.fiscals.destroy', $fiscal) }}">
										@csrf
										@method('DELETE')
										<button type="submit" onclick="return confirm('¿Está seguro que desea eliminar fiscal?')">
												<i class="fas fa-trash"></i>
										</button>
								</form>
							</td>
	        </tr>
				@endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
