@extends('layouts.app')

@section('title', 'Cambiar clave')

@section('content')

<h3 class="mb-3">Cambiar clave - usuario local</h3>

<form method="POST" class="form-horizontal" action="{{ route('rrhh.users.update_password') }}">
    @csrf
    @method('PUT')

    <div class="form-row">
        <fieldset class="form-group col-6 col-md-3">
            <label for="for_current_password">Clave Actual</label>
            <input type="password" class="form-control" name="password"
                id="password" required>
        </fieldset>

        <fieldset class="form-group col-6 col-md-3">
            <label for="for_newpassword">Nuevo Clave</label>
            <input type="password" class="form-control" name="newpassword"
                id="for_newpassword" required>
        </fieldset>

        <fieldset class="form-group col-6 col-md-3">
            <label for="fornewpassword_confirm">Confirme Nueva Clave</label>
            <input type="password" class="form-control" name="newpassword_confirm"
                id="for_newpassword_confirm" required>
        </fieldset>

    </div>

    <button type="submit" class="btn btn-primary">Cambiar</button>

</form>

@endsection

@section('custom_js')

@endsection
