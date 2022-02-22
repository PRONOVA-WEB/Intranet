@extends('layouts.app')

@section('title', 'Crear nueva Comuna')

@section('content')

@include('parameters/nav')

<h3 class="mb-3">Crear nueva Comuna</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.communes.store') }}">
    @csrf
    @method('POST')

    <div class="form-row">

        <fieldset class="form-group col-12 col-md-4">
            <label for="for_name">Nombre*</label>
            <input type="text" class="form-control" id="for_name" name="name" required>
        </fieldset>

    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-outline-secondary" href="{{ route('parameters.communes.index') }}">Volver</a>

</form>

@endsection

@section('custom_js')

@endsection
