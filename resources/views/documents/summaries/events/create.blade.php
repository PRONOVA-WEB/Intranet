@extends('layouts.app')

@section('title', 'Nuevo sumario')

@section('content')

<h3>Nuevo Evento de Sumario</h3>

<!-- <form method="post" name="form" action="{{ route('documents.store') }}" onsubmit="return validate_form()">
    @csrf -->

    <div class="form-row">
        <div class="form-group col-lg-2">
            <label for="forDate">Fecha</label>
            <input type="date" class="form-control" id="forDate" name="date" value="{{\Carbon\Carbon::now()->toDateString()}}" disabled>
        </div>
        <div class="form-group col-lg-3">
            <label for="for_antecedent">Tipo</label>
            <select class="form-control" name="">
              <option value=""></option>
              <option value="">Notificación al fiscal</option>
              <option value="">Formulación de cargos</option>
              <option value="">Solicita sobreseimiento</option>
              <option value="">Prorroga</option>
              <option value="">Cerrar Sumario</option>
            </select>
        </div>

    </div>

    <div class="form-group col-lg-12">
        <label for="for_antecedent">Observación</label>
        <textarea class="form-control" name="textarea" rows="5"></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-4">Guardar</button>
    </div>
<!-- </form> -->

@endsection

@section('custom_js')

@endsection
