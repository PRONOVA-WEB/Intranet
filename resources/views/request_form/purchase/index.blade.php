@extends('layouts.app')
@section('title', 'Formulario de requerimiento')
@section('content')

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
<h4 class="mb-3">Formularios de requerimiento - Bandeja de entrada abastecimiento</h4>

@include('request_form.partials.nav')

@if(!$my_request_forms->isEmpty())
</div>
<div class="col">
    <div class="table-responsive">
        <h6><i class="fas fa-inbox"></i> Mis Formularios asignados</h6>
        <table class="table table-sm table-striped table-bordered small">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Folio</th>
                    <th style="width: 7%">Fecha Creación</th>
                    <th>Tipo / Mecanismo de Compra</th>
                    <th>Descripción</th>
                    <th>Usuario Gestor</th>
                    <th>Items</th>
                    <th>Presupuesto</th>
                    <th>Espera</th>
                    <th>Etapas de aprobación</th>
                    <th></th>
                </tr>
            </thead>
          <tbody>
                @foreach($my_request_forms as $requestForm)
                        <tr>
                            <td>{{ $requestForm->id }}</td>
                            <td>{{ $requestForm->folio }}</td>
                            <td style="width: 7%">{{ $requestForm->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ ($requestForm->purchaseMechanism) ? $requestForm->purchaseMechanism->PurchaseMechanismValue : '' }}<br>
                                {{ $requestForm->SubtypeValue }}
                            </td>
                            <td>{{ $requestForm->name }}</td>
                            <td>{{ $requestForm->user ? $requestForm->user->FullName : 'Usuario eliminado' }}<br>
                                {{ $requestForm->user ? $requestForm->userOrganizationalUnit->name : 'Usuario eliminado' }}
                            </td>
                            <td>{{ $requestForm->quantityOfItems() }}</td>
                            <td class="text-right">{{$requestForm->symbol_currency}}{{ number_format($requestForm->estimated_expense,$requestForm->precision_currency,",",".") }}</td>
                            <td>{{ $requestForm->created_at->diffForHumans() }}</td>
                            <td>
                            @foreach($requestForm->eventRequestForms as $sign)
                                @if($sign->status == 'pending')
                                    <i class="fas fa-clock fa-2x" title="{{ $sign->signerOrganizationalUnit->name }}"></i>
                                @endif
                                @if($sign->status == 'approved')
                                    <span style="color: green;">
                                        <i class="fas fa-check-circle fa-2x" title="{{ $sign->signerOrganizationalUnit->name }}"></i>
                                    </span>
                                @endif
                                @if($sign->status == 'rejected')
                                    <span style="color: Tomato;">
                                        <i class="fas fa-times-circle fa-2x" title="{{ $sign->signerOrganizationalUnit->name }}"></i>
                                    </span>
                                @endif
                            @endforeach
                            </td>
                            <td>
                                @if($requestForm->signatures_file_id)
                                  @if($requestForm->signatures_file_id == 11)
                                  <a class="btn btn-info btn-sm"
                                      title="Ver Formulario de Requerimiento firmado"
                                      href="{{ route('request_forms.show_file', $requestForm->requestFormFiles->first() ?? 0) }}"
                                      target="_blank" title="Certificado">
                                        <i class="fas fa-file-contract"></i>
                                  </a>
                                  @else
                                  <a class="btn btn-info btn-sm" title="Ver Formulario de Requerimiento firmado" href="{{ route('request_forms.signedRequestFormPDF', [$requestForm, 1]) }}" target="_blank" title="Certificado">
                                    <i class="fas fa-file-contract"></i>
                                  </a>
                                  @endif
                                  @if($requestForm->old_signatures_file_id)
                                  <a class="btn btn-secondary btn-sm" title="Ver Formulario de Requerimiento Anterior firmado" href="{{ route('request_forms.signedRequestFormPDF', [$requestForm, 0]) }}" target="_blank" title="Certificado">
                                    <i class="fas fa-file-contract"></i>
                                  </a>
                                  @endif
                                @endif
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="">
                                <a href="{{ route('request_forms.supply.purchase', $requestForm) }}"
                                    class="btn btn-outline-secondary btn-sm"><i class="fas fa-shopping-cart"></i></a>
                                </span>
                            </td>
                        </tr>
                @endforeach
          </tbody>
        </table>
    </div>
</div>
@else
    <h6><i class="fas fa-inbox"></i> Mis Formularios asignados</h6>
    <div class="card">
        <div class="card-body">
        No hay formularios de requerimiento para mostrar.
        </div>
    </div>
@endif

@if(!$request_forms->isEmpty())
</div>
<div class="col">
    <div class="table-responsive">
        <h6><i class="fas fa-inbox"></i> Formularios asignados</h6>
        <table class="table table-sm table-striped table-bordered small">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Folio</th>
                    <th style="width: 7%">Fecha Creación</th>
                    <th>Tipo / Mecanismo de Compra</th>
                    <th>Descripción</th>
                    <th>Usuario Gestor</th>
                    <th>Comprador a cargo</th>
                    <th>Items</th>
                    <th>Presupuesto</th>
                    <th>Espera</th>
                    <th>Etapas de aprobación</th>
                    <th></th>
                </tr>
            </thead>
          <tbody>
                @foreach($request_forms as $requestForm)
                        <tr>
                            <td>{{ $requestForm->id }}</td>
                            <td>{{ $requestForm->folio }}</td>
                            <td style="width: 7%">{{ $requestForm->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ ($requestForm->purchaseMechanism) ? $requestForm->purchaseMechanism->PurchaseMechanismValue : '' }}<br>
                                {{ $requestForm->SubtypeValue }}
                            </td>
                            <td>{{ $requestForm->name }}</td>
                            <td>{{ $requestForm->user ? $requestForm->user->FullName : 'Usuario eliminado' }}<br>
                                {{ $requestForm->user ? $requestForm->userOrganizationalUnit->name : 'Usuario eliminado' }}
                            </td>
                            <td>@foreach($requestForm->purchasers as $purchaser) {{ $purchaser->FullName }} <br> @endforeach</td>
                            <td>{{ $requestForm->quantityOfItems() }}</td>
                            <td class="text-right">{{$requestForm->symbol_currency}}{{ number_format($requestForm->estimated_expense,$requestForm->precision_currency,",",".") }}</td>
                            <td>{{ $requestForm->created_at->diffForHumans() }}</td>
                            <td>
                            @foreach($requestForm->eventRequestForms as $sign)
                                @if($sign->status == 'pending')
                                    <i class="fas fa-clock fa-2x" title="{{ $sign->signerOrganizationalUnit->name }}"></i>
                                @endif
                                @if($sign->status == 'approved')
                                    <span style="color: green;">
                                        <i class="fas fa-check-circle fa-2x" title="{{ $sign->signerOrganizationalUnit->name }}"></i>
                                    </span>
                                @endif
                                @if($sign->status == 'rejected')
                                    <span style="color: Tomato;">
                                        <i class="fas fa-times-circle fa-2x" title="{{ $sign->signerOrganizationalUnit->name }}"></i>
                                    </span>
                                @endif
                            @endforeach
                            </td>
                            <td>
                                @if($requestForm->iAmPurchaser())
                                @if($requestForm->signatures_file_id)
                                  @if($requestForm->signatures_file_id == 11)
                                  <a class="btn btn-info btn-sm"
                                      title="Ver Formulario de Requerimiento firmado"
                                      href="{{ route('request_forms.show_file', $requestForm->requestFormFiles->first() ?? 0) }}"
                                      target="_blank" title="Certificado">
                                        <i class="fas fa-file-contract"></i>
                                  </a>
                                  @else
                                  <a class="btn btn-info btn-sm" title="Ver Formulario de Requerimiento firmado" href="{{ route('request_forms.signedRequestFormPDF', [$requestForm, 1]) }}" target="_blank" title="Certificado">
                                    <i class="fas fa-file-contract"></i>
                                  </a>
                                  @endif
                                  @if($requestForm->old_signatures_file_id)
                                  <a class="btn btn-secondary btn-sm" title="Ver Formulario de Requerimiento Anterior firmado" href="{{ route('request_forms.signedRequestFormPDF', [$requestForm, 0]) }}" target="_blank" title="Certificado">
                                    <i class="fas fa-file-contract"></i>
                                  </a>
                                  @endif
                                @endif
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="">
                                <a href="{{ route('request_forms.supply.purchase', $requestForm) }}"
                                    class="btn btn-outline-secondary btn-sm"><i class="fas fa-shopping-cart"></i></a>
                                </span>
                                @endif
                            </td>
                        </tr>
                @endforeach
          </tbody>
        </table>
    </div>
    {{ $request_forms->links() }}
</div>
@else
    <h6><i class="fas fa-inbox"></i> Formularios asignados</h6>
    <div class="card">
        <div class="card-body">
        No hay formularios de requerimiento para mostrar.
        </div>
    </div>
@endif

@endsection

@section('custom_js')

@endsection

@section('custom_js_head')

@endsection
