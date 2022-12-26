@extends('layouts.app')

@section('title', 'Viáticos')

@section('content')

@include('allowances.partials.nav')

<h5><i class="fas fa-file"></i> Todos los viáticos</h5>

<br />
</div>

<!-- <div class="row"> -->
    <div class="col-sm">
        @livewire('allowances.search-allowances', [
            'index' => 'all'
        ])
    </div>
<!-- </div> -->

@endsection

@section('custom_js')

@endsection