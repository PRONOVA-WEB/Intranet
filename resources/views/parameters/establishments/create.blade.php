@extends('layouts.app')

@section('title', 'Crear Lugar')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Crear Establecimiento</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.establishments.store') }}">
    @csrf

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_type">Tipo*</label>

            <select name="type" id="for_type" class="form-control" required>
                <option value="HOSPITAL">HOSPITAL</option>
                <option value="CESFAM">CESFAM</option>
                <option value="CECOSF">CECOSF</option>
                <option value="PSR">PSR</option>
                <option value="CGR">CGR</option>
                <option value="SAPU">SAPU</option>
                <option value="COSAM">COSAM</option>
                <option value="PRAIS">PRAIS</option>
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" id="for_name"
            placeholder="Ej. Servicio de Salud" name="name">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_deis">Deis</label>
            <input type="text" class="form-control" id="for_deis"
            placeholder="Ej. 111300" name="deis">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_sirh_code ">CÓD.SIRH</label>
            <input type="text" class="form-control" id="for_sirh_code "
            {{-- placeholder=""  --}}
            name="sirh_code"
            >
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_commune_id">Comuna</label>
            <select name="commune_id" id="for_commune_id" class="form-control" required>
                @foreach($communes as $commune)
                    <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                @endforeach
            </select>
        </fieldset>

    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-outline-secondary" href="{{ route('parameters.establishments.index') }}">Volver</a>

</form>

@endsection

@section('custom_js')

@endsection
