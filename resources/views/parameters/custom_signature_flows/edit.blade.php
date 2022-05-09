@extends('layouts.app')

@section('title', 'Editar flujo de firmas')

@section('content')

@include('parameters/nav')

<h3 class="mb-3">Editar Flujo de Firmas</h3>

<form method="POST" class="form-horizontal" action="{{ route('documents.custom_signature_flows.update', $customSignatureFlow) }}">
    @csrf
    @method('PUT')

    <div class="form-row">

        <fieldset class="form-group col col-md">
            <label for="for_name">Unidad organizacional*</label>
            <select name="ou_id" class="form-control selectpicker" for="for_ou_id" required>
                <option value="" ></option>
                @foreach ($organizationalUnit as $key => $unit)
                <option value="{{$unit->id}}" @if ($unit->id == $customSignatureFlow->ou_id))
                selected @endif>{{$unit->name}}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col col-md">
            <label for="for_name">Nombre*</label>
            <input type="text" class="form-control" id="for_flow_name" name="flow_name" value="{{$customSignatureFlow->flow_name}}" autocomplete="off" required>
        </fieldset>        

    </div>
    
    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Actualizar</button></div>
</form>

<hr>

<h3 class="mb-3">Firmantes</h3>

<a class="btn btn-primary mb-3" href="{{ route('documents.custom_signature_flows.signatories.create',$customSignatureFlow) }}">Agregar</a>
<table class="table table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Firmante</th>
            <th>Posición</th>     
            <th></th>                 
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($customSignatureFlow->signatories->sortBy('order') as $signatory)
        <tr>
            <td>{{ $signatory->id }}</td>
            <td>{{ $signatory->signator->getFullNameAttribute() }}</td>
            <td>{{ $signatory->order }}</td>
            <td>
                @if($customSignatureFlow->signatories->min('order') == $signatory->order)
                    <a href="{{ route('documents.custom_signature_flows.signatories.move_down', $signatory )}}">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                @elseif($customSignatureFlow->signatories->max('order')== $signatory->order)
                    <a href="{{ route('documents.custom_signature_flows.signatories.move_up', $signatory )}}">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                @else
                    <a href="{{ route('documents.custom_signature_flows.signatories.move_up', $signatory )}}">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="{{ route('documents.custom_signature_flows.signatories.move_down', $signatory )}}">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                @endif
            </td>
            <td>
                <a href="{{ route('documents.custom_signature_flows.signatories.destroy', $signatory )}}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
