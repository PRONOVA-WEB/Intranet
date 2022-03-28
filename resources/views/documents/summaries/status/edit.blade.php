@extends('layouts.app')

@section('title', 'Editar estado')

@section('content')

@include('documents.summaries.partials.nav')

<h3>Editar Estado</h3>

<!-- <form method="post" name="form" action="{{ route('documents.store') }}" onsubmit="return validate_form()">
    @csrf -->

    <div class="form-row">
        <div class="form-group col-lg-3">
            <label for="forNumber">ID</label>
            <input type="text" class="form-control" id="forNumber" name="number" value="{{$summary->id}}" disabled>
        </div>
        <div class="form-group col-lg-3">
            <label for="forNumber">Nro Resolución</label>
            <input type="text" class="form-control" id="forNumber" name="number" value="{{$summary->resolution_number}}" disabled>
        </div>
        <!-- <div class="form-group col-lg-2">
            <label for="forDate">Fecha</label>
            <input type="date" class="form-control" id="for_summary_date" name="summary_date" value="{{$summary->summary_date->toDateString()}}" disabled>
        </div> -->
        <div class="form-group col-lg-3">
            <label for="for_antecedent">Tipo</label>
            <select class="form-control" name="type" disabled>
              <option value="Sumario administrativo" @if($summary->type == 'Sumario administrativo') selected @endif>Sumario administrativo</option>
              <option value="Investigación sumaria" @if($summary->type == 'Investigación sumaria') selected @endif>Investigación sumaria</option>
            </select>
        </div>
        <div class="form-group col-lg-3">
            <label for="for_antecedent">Fiscal</label>
            <select class="form-control" name="fiscal_id" disabled>
              @foreach($fiscals as $fiscal)
                <option value="{{$fiscal->user->id}}" @if($summary->fiscal_id == $fiscal->id) selected @endif>{{$fiscal->user->getFullNameAttribute()}}</option>
              @endforeach
            </select>
        </div>
    </div>
    <!-- <div class="form-row">
        <fieldset class="form-group col-12 col-md-6">
        </fieldset>

        <fieldset class="form-group col-12 col-md-6">
            <label for="forFile">Adjuntar archivos</label>
            <input type="file" class="form-control-file" id="forfile" name="forfile[]" multiple>
        </fieldset>
    </div> -->
    <div class="form-row">
      <div class="form-group col-lg-12">
          <label for="for_antecedent">Materia</label>
          <textarea class="form-control" name="matter" rows="5" disabled>
            {{$summary->matter}}
          </textarea>
      </div>
    </div>

<!-- </form> -->

    <hr>
    <h4>Eventos</h4>

    <div class="mb-3">
    	<a class="btn btn-primary"
    		href="{{ route('documents.summaries.events.create',$summary) }}">
    		<i class="fas fa-shopping-cart"></i> Nuevo evento
    	</a>
    </div>

    <div class="table-responsive">
      <table class="card-table table table-sm table-bordered">
          <thead>
            <tr>
              <!-- FALTA AQUI HACERLO DINAMICO -->
              <th scope="col">Fecha</th>
              <th scope="col">Tipo</th>
              <th scope="col">Funcionario</th>
              <th scope="col">Unidad/Departamento</th>
              <th>Observaciones</th>
              <th>Días otorgados</th>
              <th>T. desde el evento</th>
              <!-- <th></th> -->
            </tr>
          </thead>
          <tbody>
            @foreach($summary->events as $event)
              <tr>
                <td>{{$event->event_date}}</td>
                <td>{{$event->status->name}}</td>
                <td>{{$event->creator->getFullNameAttribute()}}</td>
                <td>{{$event->creator->organizationalUnit->name}}</td>
                <td>{{$event->observation}}</td>
                <td>{{$event->granted_days}}</td>
                <td>{{$event->event_date->diffForHumans()}}</td>
                <!-- <td></td> -->
              </tr>
            @endforeach
          </tbody>
      </table>
      </div>

      <!-- apertura - notificación al fiscal - formulación de cargos - solicita sobreseimiento - prorroga - cerrar el sumario reapertura. -->


@endsection

@section('custom_js')

@endsection
