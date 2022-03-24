@extends('layouts.app')

@section('title', 'Nuevo evento')

@section('content')

<h3>Nuevo Evento de Sumario</h3>

<form method="post" name="form" action="{{ route('documents.summaries.events.store',$summary) }}" onsubmit="return validate_form()" enctype="multipart/form-data">
    @csrf

    @livewire('documents.summaries.status-get-granted-days',['summaryStatus'=>$summaryStatus])

    <div class="form-row">
      <div class="form-group col-lg-12">
          <label for="for_antecedent">Observación</label>
          <textarea class="form-control" name="observation" rows="5"></textarea>
      </div>
    </div>

    <div class="form-row">
        <fieldset class="form-group col-sm-6">
            <label for="forFile">Adjuntar archivo Res.</label>
            <input type="file" class="form-control-file" id="forFile" name="resol_file">
        </fieldset>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-4">Guardar</button>
    </div>
</form>

@endsection

@section('custom_js')

@endsection
