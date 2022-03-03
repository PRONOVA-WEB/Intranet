@extends('layouts.app')

@section('title', 'Crear nuevo Cargo')

@section('content')

@include('parameters/nav')

<h3 class="mb-3">Crear nuevo Cargo</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.positions.store') }}">
    @csrf
    @method('POST')

    <div class="form-row">

        <fieldset class="form-group col-12 col-md-4">
            <label for="for_name">Nombre*</label>
            <input type="text" class="form-control" id="for_name" name="name" required>
        </fieldset>

    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    <a class="btn btn-outline-secondary mt-3" href="{{ route('parameters.positions.index') }}">Volver</a>

</form>

@endsection

@section('custom_js')

@endsection
