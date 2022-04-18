@extends('layouts.app')

@section('title', 'Crear feriado')

@section('content')

@include('parameters/nav')

<h3 class="mb-3">Crear feriado</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.holidays.store') }}">
    @csrf
    @method('POST')

    <div class="form-row">
        <fieldset class="form-group col-lg-6">
            <label for="name">Nombre*</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </fieldset>
        <fieldset class="form-group col-lg-6">
            <label for="for_description">Fecha*</label>
            <input type="date" class="form-control" name="date" required>
            <input type="hidden" value="IV" name="region">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-outline-secondary" href="{{ route('parameters.holidays.index') }}">Volver</a>

</form>

@endsection
