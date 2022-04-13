@extends('layouts.app')

@section('title', 'Gestion de Turnos')

@section('content')
    @include('rrhh.shift_management.tabs', ['actuallyMenu' => 'shiftclose'])
    <div class="row mb-3 mt-2">
        <div class="col-md-12">
            <h3> Cierre de turnos</h3>
        </div>
    </div>
    <form method="post" action="{{ route('rrhh.shiftManag.closeShift.saveDate') }} ">
        @csrf
        <div class="form-row">
            <div class="col-md-2">
                <label for="for_name">Fecha de inicio</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="initDate" value="{{ $cierreDelMes->init_date }}"
                        aria-describedby="basic-addon2">
                </div>
            </div>
            <div class="col-md-2">
                <label for="for_name">Fecha de cierre</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" value="{{ $cierreDelMes->close_date }}" name="closeDate"
                        aria-describedby="basic-addon2">
                    <input type="hidden" name="id" value="{{ $cierreDelMes->id }}">
                </div>
            </div>
            <div class="col-md-1">
                <label for="for_name" style="color:white">.</label>
                <div class="input-group-append">
                    @if ($cierreDelMes->id != 0)
                        <button class="btn btn-warning">Modificar</button>
                    @endif
                    <button class="btn btn-primary ml-2" name="new" value="true">Crear</button>
                </div>
            </div>
        </div>
    </form>
    <br>
    @if($cierres->count() > 0)
    <h4>Filtros</h4>
    <form method="post" action="{{ route('rrhh.shiftManag.closeShift') }}" name="menuFilters">
        @csrf
        <!-- Menu de Filtros  -->
        <div class="form-row">
            <div class="col-md-4">
                <label for="for_name">Cierres</label>
                <div class="input-group mb-3">
                    <select class="form-control" name="idCierre" id="idCierre">
                        @foreach ($cierres as $c)
                        <option value="{{ $c->id }}" {{ $cierreDelMes->id == $c->id ? 'selected' : '' }}>
                        #{{ $c->id }} - Del {{ dateCustomFormat($c->init_date) }} al {{ dateCustomFormat($c->close_date) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="for_name">Unidad organizacional</label>
                <select class="form-control selectpicker" id="for_orgunitFilter" name="orgunitFilter"
                    data-live-search="true" required data-size="5">
                    @foreach ($ouRoots as $ouRoot)
                        @if ($ouRoot->name != 'Externos')
                            <option value="{{ $ouRoot->id }}" {{ $ouRoot->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                {{ $ouRoot->id ?? '' }}-{{ $ouRoot->name }}
                            </option>
                            @foreach ($ouRoot->childs as $child_level_1)
                                <option value="{{ $child_level_1->id }}"
                                    {{ $child_level_1->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp;&nbsp;
                                    {{ $child_level_1->id ?? '' }}-{{ $child_level_1->name }}
                                </option>
                                @foreach ($child_level_1->childs as $child_level_2)
                                    <option value="{{ $child_level_2->id }}"
                                        {{ $child_level_2->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ $child_level_2->id ?? '' }}-{{ $child_level_2->name }}
                                    </option>
                                    @foreach ($child_level_2->childs as $child_level_3)
                                        <option value="{{ $child_level_3->id }}"
                                            {{ $child_level_3->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $child_level_3->id ?? '' }}-{{ $child_level_3->name }}
                                        </option>
                                        @foreach ($child_level_3->childs as $child_level_4)
                                            <option value="{{ $child_level_4->id }}"
                                                {{ $child_level_4->id == $actuallyOrgUnit->id ? 'selected' : '' }}>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $child_level_4->id ?? '' }}-{{ $child_level_4->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="filtrados" id="filtrados" value="0,0,0">
            <div class="form-group col-md-2">
                <label for="for_submit">&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control">Filtrar <i class="fa fa-filter"></i></button>
            </div>
            </form>
            {{-- <div class="form-group col-md-1">
            <form action="{{ route('rrhh.shiftManag.closeShift.delete') }}" method="post">
                @csrf
                <label for="for_submit">&nbsp;</label>
                <input type="hidden" name="idCierreDelete" id="idCierreDelete" value="{{ $cierreDelMes->id }}">
                <button type="submit" class="btn btn-danger form-control">Borrar <i class="fas fa-times"></i></button>
            </form>
            </div> --}}
        </div>
    @endif
    <div class="card border-left-primary shadow h-100 py-2 mb-4">
        <div class="card-body">
            <h4 class="font-weight-bold text-primary">Cerrados</h4>
            @if (count($closed) > 0)
                <small class="form-check float-right">
                    <input class="form-check-input" type="checkbox" value="1" id="onlyClosedByMe" name="onlyClosedByMe"
                        onchange="setValueToFiltrados()" {{ $onlyClosedByMe != 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        Sólo mis turnos cerrados
                    </label>
                </small>
                <br>
            @endif
            <table class="table table-sm" id="tblCerrados">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Cant. horas</th>
                        <th>Comentarios</th>
                        <th>Cerrado por</th>
                        <th>Fecha cierre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($closed as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c->user->runFormat() }}</td>
                            <td>{{ $c->user->getFullNameAttribute() }}</td>
                            <td>{{ $c->total_hours }}</td>
                            <td>{{ $c->close_commentary }}</td>
                            <td>{{ \App\User::find($c->close_user_id)->getFullNameAttribute() }}</td>
                            <td>{{ dateCustomFormatHms($c->close_date) }}</td>
                            <td>
                                <div style=" display: inline;">
                                    @if (isset($c->user))
                                        <button class="btn btn-sm btn-info mt-2" data-toggle="modal" data-target="#shiftcontrolformmodal{{ $c->user->id }}"
                                            data-backdrop="static">
                                            <i class="fa fa-eye " wire:click.prevent="setValues({{ $c->user->id }})"  wire:key="$loop->index"></i> Ver
                                        </button>
                                    @endif
                                </div>
                                @livewire( 'rrhh.see-shift-control-form', ['usr'=>$c->user,
                                'actuallyYears'=>$actuallyYear,'actuallyMonth'=>$actuallyMonth,'close'=>$cierreDelMes->id])
                            </td>
                        </tr>
                    @endforeach
                    @if (count($closed) < 1)
                        <tr>
                            <td colspan="6" style="text-align:center">
                                Sin registro de cerrados en este rango de fechas
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card border-left-info shadow h-100 py-2 mb-4">
        <div class="card-body">
            <h4 class="font-weight-bold text-info">Confirmados</h4>
            @if(count($firstConfirmations) > 0)
            <form action="{{ route('rrhh.shiftManag.closeShift.massCloseConfirmation') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="arrayClosedShift" id="arrayClosedShift" value="">
                    <div class="col-md-6">
                        <input type="text" name="closedComentary" class="form-control" placeholder="Introduzca un comentario de cierre" required>
                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Cerrar en lote</button>
                    </div>
                </div>
            </form>
            <small class="form-check float-right">
                <input class="form-check-input" type="checkbox" value="1" id="onlyConfirmedByMe" name="onlyConfirmedByMe"
                    onchange="setValueToFiltrados()" {{ $onlyConfirmedByMe != 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Sólo confirmados por mí
                </label>
            </small>
            <br>
            @endif
            <table class="table table-sm" id="tblConfirmados">
                <thead class="thead-dark">
                    <tr>
                        <th><input type="checkbox" id="selectAllClosed"></th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Cant. horas</th>
                        <th>Comentarios</th>
                        <th>Confirmado por</th>
                        <th>Fecha confirmacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($firstConfirmations as $f)
                        <tr>
                            <td><input type="checkbox"  value="{{ $f->id }}" class="closedShift"></td>
                            <td>{{ $f->user->runFormat() }}</td>
                            <td>{{ $f->user->getFullNameAttribute() }}</td>
                            <td>{{ $f->total_hours }}</td>
                            <td>{{ $f->first_confirmation_commentary }}</td>
                            <td>{{ \App\User::find($f->first_confirmation_user_id)->getFullNameAttribute() }}</td>
                            <td>{{ dateCustomFormatHms($f->first_confirmation_date) }}</td>
                            <td>
                                <div style=" display: inline;">
                                    @if (isset($f->user))
                                        <button class="btn btn-sm btn-info mt-2" data-toggle="modal" data-target="#shiftcontrolformmodal{{ $f->user->id }}"
                                            data-backdrop="static">
                                            <i class="fa fa-eye " wire:click.prevent="setValues({{ $f->user->id }})"  wire:key="$loop->index"></i> Ver
                                        </button>
                                    @endif
                                </div>
                                @livewire( 'rrhh.see-shift-control-form', ['usr'=>$f->user,
                                'actuallyYears'=>$actuallyYear,'actuallyMonth'=>$actuallyMonth,'close'=>$cierreDelMes->id])
                                <form method="post" action="{{ route('rrhh.shiftManag.closeShift.closeConfirmation') }}">
                                    @csrf
                                    <input type="hidden" name="ShiftCloseId" value="{{ $f ? $f->id : '' }}">
                                    <button class="btn btn-success btn-sm mt-2"><i class="fas fa-check"></i> Cerrar</button>
                                </form>

                                <form method="post" action="{{ route('rrhh.shiftManag.closeShift.sendToPending') }}">
                                    @csrf
                                    <input type="hidden" name="ShiftCloseId" value="{{ $f ? $f->id : '' }}">
                                    <button class="btn btn-warning btn-sm mt-2"><i class="fas fa-arrow-down"></i> Pendiente</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if (count($firstConfirmations) < 1)
                        <tr>
                            <td colspan="6" style="text-align:center">
                                Sin registro de confirmados en este rango de fechas
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card border-left-warning shadow h-100 py-2 mb-4">
        <div class="card-body">
            <h4 class="font-weight-bold text-warning">Pendientes</h4>
            @if(count($staffInShift) > 0)
            <form action="{{ route('rrhh.shiftManag.closeShift.massFirstConfirmation') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="cierreId" value="{{ $cierreDelMes && $cierreDelMes->id ? $cierreDelMes->id : '' }}">
                    <input type="hidden" name="arrayPendingShift" id="arrayPendingShift" value="">
                    <div class="col-md-6">
                        <input type="text" name="pendingComentary" class="form-control" placeholder="Introduzca un comentario" required>
                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Confirmar en lote</button>
                    </div>
                </div>
            </form>
            <br>
            @endif
            <table class="table table-sm" id="tblPendientes">
                <thead class="thead-dark">
                    <tr>
                        <th><input type="checkbox" id="selectAllPending"></th>
                        <th>RUT</th>
                        <th>Nombre</th>
                        <th>Tipo de Turno</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffInShift as $s)
                        <tr>
                            <td><input type="checkbox"  value="{{ $s->id }}" class="pendingShift"> </td>
                            <td>{{ $s->user && $s->user->id ? $s->user->runFormat() : '' }}</td>
                            <td>{{ $s->user && $s->user->id ? $s->user->getFullNameAttribute() : '' }}</td>
                            <td>{{ $s->shiftType->name }}</td>
                            <form method="post" action="{{ route('rrhh.shiftManag.closeShift.firstConfirmation') }}">
                                <td>
                                    <textarea class="form-control" name="comment" id="comment1_{{ $s->id }}"
                                        placeholder="Ingrese un comentario  "></textarea>
                                </td>
                                <td>
                                    @csrf
                                    {{ method_field('post') }}
                                    <input type="hidden" name="userId" value="{{ $s->user && $s->user->id ? $s->user->id : '' }}">
                                    <input type="hidden" name="cierreId" value="{{ $cierreDelMes && $cierreDelMes->id ? $cierreDelMes->id : '' }}">
                                    {{-- json_encode($cierreDelMes --}}
                                    <button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Confirmar</button>
                                    <!-- <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success">Confirmar</button> -->
                            </form>
                            <form method="post" id="rejectForm_{{ $s->id }}"
                                action="{{ route('rrhh.shiftManag.closeShift.firstConfirmation') }}">
                                @csrf

                                <input type="hidden" name="userId" value="{{ $s->user && $s->user->id ? $s->user->id : '' }}">
                                <input type="hidden" name="cierreId"
                                    value="{{ $cierreDelMes && $cierreDelMes->id ? $cierreDelMes->id : '' }}">
                                <input type="hidden" name="rechazar" value="1">
                                <input type="hidden" name="comment" id="comment2_{{ $s->id }}" value="">
                                <button type="button" onclick="rejectForm({{ $s->id }});"
                                    class="btn btn-danger btn-sm mt-2"><i class="fas fa-ban"></i> Rechazar</button>
                            </form>
                            <div style=" display: inline;">
                                @if (isset($s->user))
                                    <button class="btn btn-sm btn-info mt-2" data-toggle="modal" data-target="#shiftcontrolformmodal{{ $s->user->id }}"
                                        data-backdrop="static">
                                        <i class="fa fa-eye " wire:click.prevent="setValues({{ $s->user->id }})"  wire:key="$loop->index"></i> Ver
                                    </button>
                                @endif
                            </div>
                            @livewire( 'rrhh.see-shift-control-form', ['usr'=>$s->user,
                            'actuallyYears'=>$actuallyYear,'actuallyMonth'=>$actuallyMonth,'close'=>$cierreDelMes->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card border-left-danger shadow h-100 py-2 mb-4">
        <div class="card-body">
            <h4 class="font-weight-bold text-danger">Rechazados</h4>
            <small class="form-check float-right">
                <input class="form-check-input" type="checkbox" value="1" id="onlyRejectedForMe" name="onlyRejectedForMe"
                    onchange="setValueToFiltrados()" {{ $onlyRejectedForMe != 0 ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckIndeterminate">
                    Sólo rechazados por mí
                </label>
            </small>
            <br>
            <table class="table table-sm" id="tblRechazados">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>RUT</th>
                        <th>Nombre</th>
                        <th>Comentarios</th>
                        <th>Cant. horas</th>
                        <th>Rechazado por</th>
                        <th>Fecha rechazo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rejected as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->user->runFormat() }}</td>
                            <td>{{ $r->user->getFullNameAttribute() }}</td>
                            <td>{{ $r->first_confirmation_commentary }}</td>
                            <td>{{ $r->total_hours }}</td>
                            <td>{{ $r->first_confirmation_user_id }}</td>
                            <td>{{ dateCustomFormatHms($r->first_confirmation_date) }}</td>
                            <td>
                                <div style=" display: inline;">
                                    @if (isset($s->user))
                                        <button class="btn btn-sm btn-info mt-2" data-toggle="modal" data-target="#shiftcontrolformmodal{{ $s->user->id }}"
                                            data-backdrop="static">
                                            <i class="fa fa-eye " wire:click.prevent="setValues({{ $s->user->id }})"  wire:key="$loop->index"></i> Ver
                                        </button>
                                    @endif
                                </div>
                                @livewire( 'rrhh.see-shift-control-form', ['usr'=>$s->user,
                                'actuallyYears'=>$actuallyYear,'actuallyMonth'=>$actuallyMonth,'close'=>$cierreDelMes->id])
                            </td>
                        </tr>
                    @endforeach
                    @if (count($rejected) < 1)
                        <tr>
                            <td colspan="6" style="text-align:center">

                                Sin registro de rechazados en este rango de fechas

                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar horas trabajadas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:green">CONFIRMACION 1 <i class="fa fa-check	"></i> </p>
                    <p> confirmado por usuario Armando Barra Perez</p>
                    <p> Comentarios: Pueba comentario</p>
                    <p style="color:yellow;">CONFIRMACION 2 </p>
                    <p>Pendiente </p>
                    <p>Pendiente </p>
                    <br>
                    <br>
                    <b> Horas totales: 100</b>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('custom_js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#idCierre').on('change', function() {
                $('#idCierreDelete').val(this.value);
            });


            @if (count($staffInShift) > 0)
            var arrayPending = [];

            $("#selectAllPending").click(function(){
                $('.pendingShift').click();
                $(".pendingShift").prop('checked', $(this).prop('checked'));

            });
            $('.pendingShift').on('click', function() {
                if(this.checked)
                {
                    arrayPending.push(this.value);
                }
                else
                {
                    for( var i = 0; i < arrayPending.length; i++){
                        if ( arrayPending[i] === this.value) {
                            arrayPending.splice(i, 1);
                        }
                    }
                }
                //console.log(arrayPending);
                $('#arrayPendingShift').val(JSON.stringify(arrayPending));
            });
            $('#tblPendientes').DataTable({
                "order": [2, "asc"],
                "paging": false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                       columns: [ 1, 2, 3 ]
                    },
                    text: '<i class="fa fa-file-excel"></i>',
                    className: 'btn btn-outline-success float-right',
                    messageTop: 'Pendientes del {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->init_date) }} al {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->close_date) }} - {{ App\Rrhh\OrganizationalUnit::find($actuallyOrgUnit->id)->name }}',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button');
                    }
                }],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "_TOTAL_ Registros Encontrados",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                    "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                }
            });
            @endif

            @if(count($firstConfirmations) > 0)
            var arrayClosed = [];

            $("#selectAllClosed").click(function(){
                $('.closedShift').click();
                $(".closedShift").prop('checked', $(this).prop('checked'));

            });
            $('.closedShift').on('click', function() {
                if(this.checked)
                {
                    arrayClosed.push(this.value);
                }
                else
                {
                    for( var i = 0; i < arrayClosed.length; i++){
                        if ( arrayClosed[i] === this.value) {
                            arrayClosed.splice(i, 1);
                        }
                    }
                }
                //console.log(arrayClosed);
                $('#arrayClosedShift').val(JSON.stringify(arrayClosed));
            });
            $('#tblConfirmados').DataTable({
                "order": [2, "asc"],
                "paging": false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                       columns: [ 1, 2, 3, 4, 5, 6 ]
                    },
                    text: '<i class="fa fa-file-excel"></i>',
                    className: 'btn btn-outline-success float-right',
                    messageTop: 'Confirmados del {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->init_date) }} al {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->close_date) }} - {{ App\Rrhh\OrganizationalUnit::find($actuallyOrgUnit->id)->name }}',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button');
                    }
                }],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "_TOTAL_ Registros Encontrados",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                    "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                }
            });
            @endif

            @if(count($closed) > 0)
            $('#tblCerrados').DataTable({
                "order": [2, "asc"],
                "paging": false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                       columns: [ 1, 2, 3, 4, 5, 6 ]
                    },
                    text: '<i class="fa fa-file-excel"></i>',
                    className: 'btn btn-outline-success float-right',
                    messageTop: 'Cerrados del {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->init_date) }} al {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->close_date) }} - {{ App\Rrhh\OrganizationalUnit::find($actuallyOrgUnit->id)->name }}',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button');
                    }
                }],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "_TOTAL_ Registros Encontrados",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                    "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                }
            });
            @endif

            @if (count($rejected) > 0)
            $('#tblRechazados').DataTable({
                "order": [2, "asc"],
                "paging": false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                       columns: [ 1, 2, 3, 4, 5, 6 ]
                    },
                    text: '<i class="fa fa-file-excel"></i>',
                    className: 'btn btn-outline-success float-right',
                    messageTop: 'Rechazados del {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->init_date) }} al {{ dateCustomFormat(App\Models\Rrhh\ShiftDateOfClosing::find($cierreDelMes->id)->close_date) }} - {{ App\Rrhh\OrganizationalUnit::find($actuallyOrgUnit->id)->name }}',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button');
                    }
                }],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "_TOTAL_ Registros Encontrados",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                    "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                }
            });
            @endif
        });

        function setValueToFiltrados() {
            var onlyClosedByMe = 0;
            var onlyConfirmedByMe = 0;
            var onlyRejectedForMe = 0;

            if ($("#onlyConfirmedByMe").prop("checked"))
                onlyConfirmedByMe = 1;
            if ($("#onlyClosedByMe").prop("checked"))
                onlyClosedByMe = 1;
            if ($("#onlyRejectedForMe").prop("checked"))
                onlyRejectedForMe = 1;
            $("#filtrados").val(onlyClosedByMe + "," + onlyConfirmedByMe + "," + onlyRejectedForMe);
            // alert($("#filtrados").val()  );
            menuFilters.submit();
        }

        function rejectForm(idField) {
            $("#comment2_" + idField).val($("#comment1_" + idField).val());
            // alert($("#comment2_"+idField).val());
            $("#rejectForm_" + idField).submit();
        }

    </script>

@endsection
