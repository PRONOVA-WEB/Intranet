<div>
    <div class="card card-body small">
        <h5 class="mb-3"><i class="fas fa-search"></i> Buscar:</h5>
        {{-- 
        <div class="form-row">
            <fieldset class="form-group col-12 col-md-2">
                <label for="for_status_search">Estado Formulario</label>
                <select name="status_search" class="form-control form-control-sm" wire:model.debounce.500ms="selectedStatus">
                    <option value="">Seleccione...</option>
                    <option value="saved">Guardado</option>
                    <option value="pending">Pendiente</option>
                    <option value="Approved">Aprobado</option>
                    <option value="rejected">Rechazado</option>
                </select>
            </fieldset>  

            <fieldset class="form-group col-12 col-md-2">
                <label for="for_status_purchase_search">Estado Proceso Compra</label>
                <select name="status_purchase_search" class="form-control form-control-sm" wire:model.debounce.500ms="selectedStatusPurchase">
                    <option value="">Seleccione...</option>
                    <option value="canceled">Anulado</option>
                    <option value="finalized">Finalizado</option>
                    <option value="in_process">En proceso</option>
                    <option value="purchased">Comprado</option>
                </select>
            </fieldset>
            
            <fieldset class="form-group col-12 col-md-1">
                <label for="for_id">ID</label>
                <input class="form-control form-control-sm" type="number" name="id_search" autocomplete="off" 
                    placeholder="001" wire:model.debounce.500ms="selectedId">
            </fieldset>

            <fieldset class="form-group col-12 col-md-1">
                <label for="for_folio">Folio</label>
                <input class="form-control form-control-sm" type="text" name="folio_search" autocomplete="off" 
                    placeholder="2022-17" wire:model.debounce.500ms="selectedFolio">
            </fieldset>

            <fieldset class="form-group col-12 col-md-3">
                <label for="for_name">Descripción</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off"
                    name="name_search" wire:model.debounce.500ms="selectedName">
            </fieldset>

            <fieldset class="form-group col-12 col-md-3">
                <label for="regiones">Periodo de Creación</label>
                <div class="input-group">
                    <input type="date" class="form-control form-control-sm" name="start_date_search" wire:model.debounce.500ms="selectedStartDate">
                    <input type="date" class="form-control form-control-sm" name="end_date_search" wire:model.debounce.500ms="selectedEndDate">
                </div>
            </fieldset>
        
        </div>
        
        <div class="form-row">
            <fieldset class="form-group col-12 col-md-2">
                <label for="for_requester">Usuario Gestor</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" placeholder="NOMBRE / APELLIDOS"
                    name="requester_search" wire:model.debounce.500ms="selectedRequester">
            </fieldset>
            <fieldset class="form-group col-12 col-md-4">
                    <label for="for_requester_ou_id">U.O. Usuario Gestor</label>
                    @livewire('search-select-organizational-unit', [
                        'emit_name'            => 'searchedRequesterOu',
                        'selected_id'          => 'requester_ou_id',
                        'small_option'         => true,
                        'organizationalUnit'   => $organizationalUnit
                    ])
            </fieldset>
            <fieldset class="form-group col-12 col-md-2">
                <label for="for_requester">Administrador Contrato</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" placeholder="NOMBRE / APELLIDOS"
                    name="admin_search" wire:model.debounce.500ms="selectedAdmin">
            </fieldset>
            <fieldset class="form-group col-12 col-md-4">
                <label for="for_requester_ou_id">U.O. Administrador Contrato</label>
                    @livewire('search-select-organizational-unit', [
                        'emit_name'          => 'searchedAdminOu',
                        'selected_id'        => 'admin_ou_id',
                        'small_option'       => true,
                        'organizationalUnit' => $organizationalUnit
                    ])
            </fieldset>
        </div>
        <div class="form-row">
            <fieldset class="form-group col-12 col-md-2">
                <label for="for_purchaser">Comprador</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" placeholder="NOMBRE / APELLIDOS"
                    name="purchaser_search" wire:model.debounce.500ms="selectedPurchaser" @if($inbox == 'purchase') disabled @endif>
            </fieldset>
            <fieldset class="form-group col-12 col-md-2">
                <label for="for_purchaser">Programa</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" placeholder=""
                    name="program_search" wire:model.debounce.500ms="selectedProgram">
            </fieldset>
            @if($inbox == 'purchase')
            <fieldset class="form-group col-12 col-md-2">
                <label for="for_purchaser">N° O.C.</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" placeholder=""
                    name="purchase_order_search" wire:model.debounce.500ms="selectedPo">
            </fieldset>
            <fieldset class="form-group col-12 col-md-2">
                <label for="for_purchaser">N° Licitación.</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" placeholder=""
                    name="tender_search" wire:model.debounce.500ms="selectedTender">
            </fieldset>
            @endif
        </div>
        --}}
    </div>

    <br>
    <!-- TODOS LOS FORMULARIOS -->
    @if($allowances->count() > 0)
        <div class="row">
            <div class="col">
                <p class="font-weight-lighter">Total de Registros: <b>{{ $allowances->total() }}</b></p>
            </div>
            {{-- 
            <div class="col">
                <a class="btn btn-success btn-sm mb-1 float-right disabled" wire:click="export"><i class="fas fa-file-excel"></i> Exportar formularios</a></h6>
            </div>
            --}}
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped table-hover small">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th style="width: 8%">Fecha Creación</th>
                        <th>Funcionario</th>
                        <th>Calidad</th>
                        <th>Lugar</th>
                        <th>Motivo</th>
                        <th>Detalle</th>
                        <th>Periodo</th>
                        <th>Total de días</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allowances as $allowance)
                    <tr>
                        <th>{{ $allowance->id }}</th>
                        <td>{{ $allowance->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>
                            {{ $allowance->userAllowance->FullName }} <br>
                            {{ $allowance->organizationalUnitAllowance->name }}
                        </td>
                        <td>{{ $allowance->ContractualConditionValue }}</td>
                        <td>{{ $allowance->place }}</td>
                        <td>{{ $allowance->reason }}</td>
                        <td>
                            @if($allowance->round_trip == 'round trip')
                                {{ $allowance->originCommune->name }} - {{ $allowance->destinationCommune->name }} - {{ $allowance->originCommune->name }} <br>
                            @endif
                            {{ $allowance->RoundTripValue }}
                        </td>
                        <td>
                            {{ $allowance->from->format('d-m-Y') }} {{ ($allowance->from_half_day) ?  'medio día' : '' }}<br>
                            {{ $allowance->to->format('d-m-Y') }} {{ ($allowance->to_half_day) ?  'medio día' : '' }}
                            {{-- <span class="badge badge-warning">Medio día</span> --}}
                        </td>
                        <td class="text-center">
                            {{ $allowance->TotalDays }}
                        </td>
                        <td>
                            @foreach($allowance->allowanceSigns as $sign)
                                @if($sign->status == 'pending' || $sign->request_status == NULL)
                                    <i class="fas fa-clock fa-2x" title="{{-- $sign->organizationalUnit->name --}}"></i>
                                @endif
                                @if($sign->status == 'accepted')
                                    <span style="color: green;">
                                        <i class="fas fa-check-circle fa-2x" title="{{-- $sign->organizationalUnit->name --}}"></i>
                                    </span>
                                @endif
                                @if($sign->status == 'rejected')
                                    <span style="color: Tomato;">
                                        <i class="fas fa-times-circle fa-2x" title="{{-- $sign->organizationalUnit->name --}}"></i>
                                    </span>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($index == 'sign')
                                <a href="{{ route('allowances.show', $allowance) }}"
                                    class="btn btn-outline-secondary btn-sm" title="Aceptar o Declinar"><i class="fas fa-signature"></i></a>
                            @endif
                            @if($index == 'own')
                            <a href="{{ route('allowances.edit', $allowance) }}"
                                class="btn btn-outline-secondary btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <div class="col">
                <p class="font-weight-lighter">Total de Registros: <b>{{ $allowances->total() }}</b></p>
            </div>
        </div>

        <div class="alert alert-info" role="alert">
            <b>Estimado usuario</b>: No se encuentran solicitudes de viaticos según los parámetros consultados.
        </div>
    @endif
</div>