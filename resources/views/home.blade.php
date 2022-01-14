@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {!! settings('site.description') !!}
        </div>
    </div>
    @if ($phrase)
    <div class="row">
        <div class="col-lg-12">
            {{ $phrase }}
        </div>
    </div>
    @endif
</div>
@endsection
