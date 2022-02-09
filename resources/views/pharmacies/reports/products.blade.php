@extends('layouts.app')

@section('title', 'Productos')

@section('content')

@include('pharmacies.nav')

<h3>Productos</h3>

<form method="GET" class="form-horizontal" action="{{ route('pharmacies.reports.products') }}">

    <div class="input-group mb-3">
    	<div class="input-group-prepend">
    		<span class="input-group-text">Productos</span>
    	</div>
    	<select name="product_id" class="form-control">
    		<option value="0">Todos</option>
    		@foreach ($products as $key => $product)
    		<option value="{{$product->id}}" @if ($product->id == $request->get('product_id'))
    		selected
    		@endif>{{$product->name}}</option>
    		@endforeach
    	</select>

        <div class="input-group-prepend">
            <span class="input-group-text">Programa</span>
        </div>
        <input type="text" class="form-control" name="program" {{ ($request->get('program'))?'value='.$request->get('program'):'' }}>

    	<div class="input-group-append">
    		<button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Buscar
            </button>
    	</div>
    </div>

</form>

<div class="table-responsive">
	<table class="table table-striped table-sm" id="tabla_last">
		<thead>
			<tr>
				<th scope="col">PRODUCTO</th>
                <th scope="col">PROGRAMA</th>
				<th scope="col">F.VENC</th>
				<th scope="col">LOTE</th>
                <th scope="col">CANTIDAD</th>
        <th>
            <button type="button" class="btn btn-sm btn-outline-primary"
                onclick="$('#tabla_last').tblToExcel();">
                <i class="fas fa-download"></i>
            </button>
        </th>
			</tr>
		</thead>
		<tbody>

      @if($matrix[0] <> null)
      @foreach ($matrix as $key => $data)
        <tr>
          <td>{{$data['name']}}</td>
          <td>{{$data['program']}}</td>
          <td>{{ Carbon\Carbon::parse($data['due_date'])->format('d/m/Y')}}</td>
          <td>{{$data['batch']}}</td>
          <td>{{$data['cantidad']}}</td>
        </tr>
      @endforeach
      @endif

		</tbody>
	</table>
</div>

@endsection

@section('custom_js')
<script src="{{ asset('js/jquery.tableToExcel.js') }}"></script>
@endsection
