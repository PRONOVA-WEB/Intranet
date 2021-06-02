@extends('layouts.app')
@section('title', 'Formulario de requerimiento')
@section('content')

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
<h4 class="mb-3">Formularios de Requerimiento - Bandeja de Entrada Pre-Finanzas</h4>

@include('request_form.nav')


<div class="card border border-muted text-black bg-light mb-5">
  <div class="card-header text-primary h6"><i class="fas fa-list"></i> Formularios no Revisados</div>
  <div class="card-body">
    <table class="table table-striped table-sm small">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Usuario Gestor</th>
          <th scope="col">Justificación</th>
          <th scope="col">Fecha Creación</th>
          <th scope="col">Espera</th>
          <th scope="col" class="text-center">J</th>
          <th scope="col" class="text-center">F1</th>
          <th scope="col" class="text-center">F2</th>
          <th scope="col" class="text-center">A</th>
          <th scope="col" class="text-center">Opciones</th>
        </tr>
      </thead>
      <tbody>
          @foreach($waitingRequestForms as $requestForm)
                <tr>
                    <th class="align-middle" scope="row">{{ $requestForm->id }}</td>
                    <td class="align-middle">{{ $requestForm->creator ? $requestForm->creator->FullName : 'Usuario eliminado' }}</td>
                    <td class="align-middle">{{ $requestForm->justification }}</td>
                    <td class="align-middle">{{ $requestForm->created_at }}</td>
                    <td class="align-middle">{{ $requestForm->getElapsedTime() }}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('leader_ship_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('pre_finance_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('finance_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('supply_event') !!}</td>
                    <td class="text-center align-middle">
                      <a href="{{ route('request_forms.prefinance_sign', $requestForm->id) }}" class="text-primary" title="Aceptar o Rechazar">
                      <i class="fas fa-signature"></i></a>
                    </td>
                </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="card border border-muted text-black bg-light mb-5">
  <div class="card-header text-primary h6"><i class="far fa-paper-plane"></i> Formularios Aprobados por Pre-Finanzas</div>
  <div class="card-body">
    <table class="table table-striped table-sm small">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Usuario Gestor</th>
          <th scope="col">Justificación</th>
          <th scope="col">Fecha Creación</th>
          <th scope="col">Espera</th>
          <th scope="col">Última Actualziación</th>
          <th scope="col" class="text-center">J</th>
          <th scope="col" class="text-center">F1</th>
          <th scope="col" class="text-center">F2</th>
          <th scope="col" class="text-center">A</th>
        </tr>
      </thead>
      <tbody>
          @foreach($approvedRequestForms as $requestForm)
                <tr>
                    <th class="align-middle" scope="row">{{ $requestForm->id }}</td>
                    <td class="align-middle">{{ $requestForm->creator ? $requestForm->creator->FullName : 'Usuario eliminado' }}</td>
                    <td class="align-middle">{{ $requestForm->justification }}</td>
                    <td class="align-middle">{{ $requestForm->created_at }}</td>
                    <td class="align-middle">{{ $requestForm->getElapsedTime() }}</td>
                    <td class="align-middle">{{ $requestForm->updated_at }}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('leader_ship_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('pre_finance_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('finance_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('supply_event') !!}</td>
                </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>



<div class="card border border-muted text-black bg-light mb-5">
  <div class="card-header text-primary h6"><i class="fas fa-archive"></i> Formularios Cerrados o Rechazados</div>
  <div class="card-body">
    <table class="table table-striped table-sm small">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Usuario Gestor</th>
          <th scope="col">Justificación</th>
          <th scope="col">Creación</th>
          <th scope="col">Rechazo</th>
          <th scope="col">Rechazado por</th>
          <th scope="col">Comentario</th>
          <th scope="col" class="text-center">J</th>
          <th scope="col" class="text-center">F1</th>
          <th scope="col" class="text-center">F2</th>
          <th scope="col" class="text-center">A</th>
        </tr>
      </thead>
      <tbody>
          @foreach($rejectedRequestForms as $requestForm)
                <tr>
                    <th class="align-middle" scope="row">{{ $requestForm->id }}</td>
                    <td class="align-middle">{{ $requestForm->creator ? $requestForm->creator->tinnyName() : 'Usuario eliminado' }}</td>
                    <td class="align-middle">{{ $requestForm->justification }}</td>
                    <td class="align-middle">{{ $requestForm->createdDate() }}</td>
                    <td class="align-middle">{{ $requestForm->rejectedTime() }}</td>
                    <td class="align-middle">{{ $requestForm->rejectedName() }}</td>
                    <td class="align-middle">{{ $requestForm->rejectedComment() }}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('leader_ship_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('pre_finance_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('finance_event') !!}</td>
                    <td class="align-middle text-center">{!! $requestForm->eventSign('supply_event') !!}</td>
                </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
@section('custom_js')
@endsection
@section('custom_js_head')
@endsection