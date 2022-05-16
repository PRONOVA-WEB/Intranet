@extends('layouts.app')

@section('title', 'Crear nuevo flujo de firmas')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Crear Nuevo Flujo de Firmas</h3>

<form method="POST" class="form-horizontal" action="{{ route('documents.custom_signature_flows.store') }}">
    @csrf
    @method('POST')

    <div class="form-row">

        <fieldset class="form-group col col-md">
            <label for="for_name">Unidad organizacional*</label>
            <select name="ou_id" class="form-control selectpicker" for="for_ou_id" required>
                <option value=""></option>
                @foreach ($organizationalUnit as $key => $unit)
                <option value="{{$unit->id}}">{{$unit->name}}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col col-md">
            <label for="for_name">Nombre*</label>
            <input type="text" class="form-control" id="for_flow_name" name="flow_name"required>
        </fieldset>

    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
