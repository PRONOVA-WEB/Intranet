@extends('layouts.app')

@section('title', 'Crear nuevo firmante')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Crear Nuevo Firmante</h3>

<form method="POST" class="form-horizontal" action="{{ route('documents.custom_signature_flows.signatories.store') }}">
    @csrf
    @method('POST')

    <div class="form-row">

        <input type="hidden" class="form-control" id="for_orden" name="doc_custom_signature_flow_id" value="{{$customSignatureFlow->id}}">

        <div class="form-group col-lg">
            <label for="for_antecedent">Usuario</label>
            @livewire('search-select-user', ['selected_id' => 'signator_id', 'required' => 'required'])
        </div>

        <!-- <fieldset class="form-group col col-md">
            <label for="for_name">Orden*</label>
            <input type="number" class="form-control" id="for_order" name="order" required>
        </fieldset> -->

    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
