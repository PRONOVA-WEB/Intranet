@extends('layouts.app')

@section('title', 'Crear sumario')

@section('content')

@include('documents.summaries.partials.nav')

<h3>Nuevo fiscal</h3>

<form method="post" name="form" action="{{ route('documents.summaries.fiscals.store') }}" onsubmit="return validate_form()">
    @csrf
    <div class="form-row">
      <div class="form-group col-lg-12">
          <label for="for_antecedent">Usuario</label>
          @livewire('search-select-user', ['required' => 'required'])
      </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-4">Guardar</button>
    </div>
</form>

@endsection

@section('custom_js')

@endsection
