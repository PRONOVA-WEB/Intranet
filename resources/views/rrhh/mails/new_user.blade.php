@extends('layouts.mail')

@section('content')

    <div style="text-align: justify;">
        <p>Se ha creado una cuenta de usuario con los siguientes datos:</p>
        <p><strong>Nombre y Apellido: </strong>{{ $user->full_name }}</p>
        <p><strong>Usuario: </strong>{{ $user->runNotFormat() }}</p>
        <p><strong>Clave: </strong>{{ $password }}</p><br>

        <p>Puede acceder al sistema por el siguiente enlace: <a href="{{ route('login') }}">Ir</a></p><br>
        Saludos cordiales.
    </div>

@endsection

@section('firmante', settings('site.organization'))

@section('linea1', settings('site.phone'))
