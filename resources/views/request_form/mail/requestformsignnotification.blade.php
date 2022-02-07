@extends('layouts.mail')

@section('content')

<div style="text-align: justify;">

  <h4>Estimado/a: </h4>

  <br>

  <p>A través del presente, se informa que se encuentra disponible en {{ settings('site.title') }}
    un formulario de requerimiento de compras correspondiente a su Unidad Organizacional, favor ingresar
    al módulo de <strong>Abastecimento</strong> para aceptar o declinar la Solicitud.
  </p>

  <ul>
      <li><strong>Nº Solicitud</strong>: {{ $req->id }}</li>
      <li><strong>Fecha Solicitud</strong>: {{ $req->created_at->format('d-m-Y H:i:s') }}</li>
      <li><strong>Nombre Solicitud</strong>: {{ $req->name }}</li>
      <li><strong>Tipo de Visación</strong>: {{ $event->EventTypeValue }}</li>
  </ul>

  <hr>

  <ul>
      <li><strong>Solicitado por</strong>: {{ $req->user->FullName }}</li>
      <li><strong>Unidad Organizacional</strong>: {{ $req->userOrganizationalUnit->name }}</li>
      <li><strong>Administrador de Contrato</strong>: {{ $req->contractManager->FullName }}</li>
  </ul>

  <br>

<<<<<<< HEAD
  <p>Para mayor infromación favor ingresar a su Bandeja de Solicitudes.</p>
=======
  <p>Para mayor información favor ingresar a su Bandeja de Solicitudes en iOnline.</p>
>>>>>>> 57b423c3d4874fcfb5f4e575bac206351fe5e0a8

  <br>

  <p>Esto es un mensaje automático de: {{ settings('site.title') }} -  {{ settings('site.organization') }}.</p>

</div>

@endsection
