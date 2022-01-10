@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @settings(site.description)
        </div>
    </div>
</div>
@endsection
