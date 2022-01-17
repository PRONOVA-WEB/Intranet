@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')

<div class="container-fluid">
    @if ($phrase)
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <div class="text-white-50 small">Frase del día</div>
                    {{ $phrase->phrase }}
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            {!! settings('site.description') !!}
        </div>
    </div>
</div>
@endsection
