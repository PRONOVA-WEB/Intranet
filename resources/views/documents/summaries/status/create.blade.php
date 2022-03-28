@extends('layouts.app')

@section('title', 'Crear estado')

@section('content')

@include('documents.summaries.partials.nav')

<h3>Nuevo Estado</h3>

<form method="post" name="form" action="{{ route('documents.summaries.status.store') }}" onsubmit="return validate_form()">
    @csrf
    <div class="form-row">
      <div class="form-group col-lg-6">
          <label for="for_antecedent">Nombre</label>
          <input type="text" class="form-control" id="for_name" name="name">
      </div>
      <div class="form-group col-lg-6">
          <label for="for_antecedent">Días otorgados</label>
          <input type="number" class="form-control" id="for_granted_days" name="granted_days">
      </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-4">Guardar</button>
    </div>
</form>

@endsection

@section('custom_js')

@endsection
