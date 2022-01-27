@extends('layouts.mail')

@section('content')

    <div style="text-align: justify;">
        <p> {{ucfirst("{$requirementEvent->requirement->status} Requerimiento N°{$requirementEvent->requirement->id}")}}.</p>
        <p> <strong>Asunto:</strong> {{$requirementEvent->requirement->subject}}.</p>
        <p> <strong>Requerimiento:</strong> {{$requirementEvent->requirement->events->where('status', 'creado')->first()->body }}.</p>
        <p> <strong>Respuesta:</strong> {{$requirementEvent->body}}</p>
        <p> <a href="{{route('requirements.show', $requirementEvent->requirement->id)}}">Ir a requerimiento</a></p>
        <br>
        Saludos cordiales.
    </div>

@endsection

@section('firmante', settings('site.organization'))

@section('linea1', settings('site.phone'))
