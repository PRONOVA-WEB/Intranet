@extends('layouts.app')

@section('title', 'Tipo de Compra')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Mantenedor Tipo de Compra</h3>

<a class="btn btn-primary mb-3" href="{{ route('parameters.purchasetypes.create') }}">
    Crear
</a>

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchaseTypes as $purchaseType)
        <tr>
            <td>{{ $purchaseType->name }}</td>
            <td>
                <a href="{{ route('parameters.purchasetypes.edit', $purchaseType) }}">
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
