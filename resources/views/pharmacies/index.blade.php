@extends('layouts.app')

@section('title', 'Farmacia')

@section('content')

@include('pharmacies.nav')

@can('Pharmacy: manager')
    <h3 class="mb-3">Bienvenido al módulo de bodega de medicamentos</h3>
@endcan

@endsection

@section('custom_js')

@endsection
