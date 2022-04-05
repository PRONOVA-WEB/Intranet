@extends('layouts.app')

@section('title', 'Cambiar día de turno')

@section('content')
    @livewire('rrhh.edit-shift-user-day',['shiftUserDay'=>$shiftUserDay,'monthYearFilter'=>$monthYearFilter])
@endsection
