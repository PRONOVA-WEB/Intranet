@extends('layouts.app')

@section('title', 'Crear sumario')

@section('content')

@include('documents.summaries.partials.nav')

<h3>Nuevo Sumario</h3>

<form method="post" name="form" action="{{ route('documents.summaries.store') }}" onsubmit="return validate_form()">
    @csrf

    <div class="form-row">
        <div class="form-group col-lg-4">
            <label for="forNumber">Nro Resolución</label>
            <input type="text" class="form-control" id="for_resolution_number" name="resolution_number">
        </div>
        <!-- <div class="form-group col-lg-3">
            <label for="forDate">Fecha</label>
            <input type="date" class="form-control" id="for_summary_date" name="summary_date" value="{{\Carbon\Carbon::now()->toDateString()}}">
        </div> -->
        <div class="form-group col-lg-4">
            <label for="for_antecedent">Tipo</label>
            <select class="form-control" id="type" name="type">
              <option value="Sumario administrativo">Sumario administrativo</option>
              <option value="Investigación sumaria">Investigación sumaria</option>
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label for="for_antecedent">Fiscal</label>
            <select class="form-control" name="fiscal_id">
              @foreach($fiscals as $fiscal)
                <option value="{{$fiscal->id}}">{{$fiscal->user->getFullNameAttribute()}}</option>
              @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col-lg-12">
          <label for="for_antecedent">Materia</label>
          <textarea class="form-control" name="matter" rows="5"></textarea>
      </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-4">Guardar</button>
    </div>
</form>

@endsection

@section('custom_js')

@endsection
