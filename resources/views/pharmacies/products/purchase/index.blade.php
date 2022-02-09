@extends('layouts.app')

@section('title', 'Listado de Compras')

@section('content')

@include('pharmacies.nav')

<h3>Listado de Compras</h3>

<div class="mb-3">
	@canany(['Pharmacy: create'])
	<a class="btn btn-primary"
		href="{{ route('pharmacies.products.purchase.create') }}">
		<i class="fas fa-shopping-cart"></i> Nueva compra
	</a>
	@endcanany

	<button type="button" class="btn btn-outline-primary"
		onclick="$('#tabla_purchase').tblToExcel();">
		<i class="fas fa-download"></i>
	</button>
</div>


<div class="table-responsive">
	<table class="table table-striped table-sm" id="tabla_purchase">
		<thead>
			<tr>
				<th scope="col">id</th>
				<th scope="col">OC</th>
				<th scope="col">Factura</th>
				<th scope="col">Fecha</th>
				<th scope="col">Proveedor</th>
				<th scope="col">Notas</th>
				<th scope="col">Total</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($purchases as $key => $purchase)
			<tr>
				<td>{{ $purchase->id }}</td>
				<td>{{ $purchase->purchase_order }}</td>
				<td>{{ $purchase->invoice }}</td>
				<td>{{ Carbon\Carbon::parse($purchase->date)->format('d/m/Y')}}</td>
				<td>{{ $purchase->supplier->name }}</td>
				<td>{{ $purchase->notes }}</td>
				<td>{{ $purchase->purchase_order_amount }}</td>
				<td nowrap>
					@can('Pharmacy: edit_delete')
					<a href="{{ route('pharmacies.products.purchase.edit', $purchase->id) }}"
						class="btn btn-outline-secondary btn-sm">
						<span class="fas fa-edit" aria-hidden="true"></span>
					</a>
					<form method="POST" action="{{ route('pharmacies.products.purchase.destroy', $purchase) }}" class="d-inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Está seguro de eliminar la información?');">
							<span class="fas fa-trash-alt" aria-hidden="true"></span>
						</button>
					</form>
					@endcan

					<a href="{{ route('pharmacies.products.purchase.record', $purchase) }}"
						class="btn btn-outline-secondary btn-sm" target="_blank">
						<span class="fas fa-file" aria-hidden="true"></span>
					</a>
					@can('Pharmacy: sign')
					    @livewire('pharmacies.sign-purchase-record', ['purchase' => $purchase])
					@endcan
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

{{-- {{ $purchases->links() }} --}}

@endsection

@section('custom_js')
<script src="{{ asset('js/jquery.tableToExcel.js') }}"></script>
@endsection
