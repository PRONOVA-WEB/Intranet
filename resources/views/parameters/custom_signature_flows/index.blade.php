@extends('layouts.app')

@section('title', 'Flujos de firmas')

@section('content')

@include('parameters/nav')
<h3 class="mb-3">Flujos de Firmas</h3>

<a class="btn btn-primary mb-3" href="{{ route('documents.custom_signature_flows.create') }}">Crear</a>
<table class="table table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Unidad Organizacional</th>            
            <th>Creador</th>     
            <th>F.Creación</th>             
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customSignatureFlows as $customSignatureFlow)
        <tr>
            <td>{{ $customSignatureFlow->id }}</td>
            <td>{{ $customSignatureFlow->flow_name }}</td>
            <td>{{ $customSignatureFlow->organizationalUnit->name }}</td>
            <td>{{ $customSignatureFlow->creator->getFullNameAttribute() }}</td>
            <td>{{ $customSignatureFlow->created_at }}</td>
            <td>
                <a href="{{ route('documents.custom_signature_flows.edit', $customSignatureFlow )}}">
                <i class="fas fa-edit"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection