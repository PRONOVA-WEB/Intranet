@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')

<div class="container-fluid">
    @if (!empty(settings('site.phrase_day')))
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <div class="text-white-50 small">Frase del día</div>
                    {{ settings('site.phrase_day') }}
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 ">
                    {{ settings('site.organization') }}
                </div>
            <div class="card-body">
                {!! settings('site.description') !!}
            </div>
        </div>
    </div>
</div>
@endsection
