@extends('layouts.mail')

@section('content')

<div style="text-align: justify;">
    <p>Junto con saludar cordialmente.</p>
    <p>Adjunto documento indicado para conocimiento y fines.</p>
    <p> <strong>Tipo:</strong> {{ $document->type }}</p>
    <p> <strong>Número:</strong> {{ $document->number }}</p>
    <p> <strong>Fecha del documento: </strong> {{ $document->date->format('d-m-Y') }} </p>
    <p> <strong>Archivo:</strong> {{ $document->type }}_{{ $document->number }}.pdf</p>
    <br>
    Saludos cordiales.
</div>

@endsection

@section('firmante', settings('site.organization'))

@section('linea1', settings('site.phone'))

@section('linea2', 'Linea 2')

@section('linea3', 'Linea 3')
