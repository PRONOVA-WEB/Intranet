@extends('layouts.app')

@section('title', 'Editar Autoridad')

@section('content')
<h3 class="mb-3">Editar Autoridad</h3>

<div class="alert alert-warning" role="alert">
    <b>Atención:</b> Si las fechas corresponden a un nuevo período, debe crear una nueva autoridad, con el botón "Crear" de la página anterior. <br>
    Nunca edite las fechas de una autoridad que ya existe, de lo contrario se perderá el histórico.
</div>


@can('Authorities: edit')
<form method="POST" class="form-horizontal" action="{{ route('rrhh.authorities.update',$authority->id) }}">
    @csrf
    @method('PUT')

    <div class="form-row">
        <fieldset class="form-group col-lg-12">
            <label for="for_organizational_unit_id">Unidad Organizacional*</label>
            @livewire('select-organizational-unit', [
                'establishment_id' => $ouTopLevel->establishment->id,
                'organizational_unit_id' => $authority->organizational_unit_id
            ])
        </fieldset>
    </div>

    <div class="form-row">
        <fieldset class="form-group col-lg-6">
            <label for="for_user_id">Funcionario*</label>
            @livewire('search-select-user', ['user' => $authority->user])
        </fieldset>

        <fieldset class="form-group col-lg-3">
            <label for="for_from">Desde*</label>
            <input required type="date" class="form-control" id="for_from" name="from" required value="{{ $authority->from->format('Y-m-d') }}">
        </fieldset>

        <fieldset class="form-group col-lg-3">
            <label for="for_to">Hasta*</label>
            <input required type="date" class="form-control" id="for_to" name="to" required value="{{ $authority->to->format('Y-m-d') }}">
        </fieldset>
    </div>
    <div class="form-row">
        <fieldset class="form-group col-lg-4">
            <label for="for_position">Cargo*</label>
            <select name="position_id" id="for_position_id" class="form-control" required>
                @foreach($positions as $position)
                <option value="{{ $position->id }}" {{ ($position->id == $authority->position_id) ? 'selected' : '' }}>{{ $position->name }}</option>
                @endforeach
            </select>
        </fieldset>


        <fieldset class="form-group col-lg-4">
            <label for="for_type">Tipo*</label>
            <select name="type" id="for_type" class="form-control" required>
                <option value="manager" {{ ($authority->type == 'manager')?'selected':'' }}>Encargado (Jefes)</option>
                <option value="delegate" {{ ($authority->type == 'delegate')?'selected':'' }}>Delegado (Igual acceso que el jefe)</option>
                <option value="secretary" {{ ($authority->type == 'secretary')?'selected':'' }}>Secretario/a</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-lg-4">
            <label for="for_decree">Decreto autorizar ejercer cargo</label>
            <input type="text" class="form-control" id="for_decree" name="decree" value="{{$authority->decree}}">
        </fieldset>
    </div>

    <fieldset class="form-group">
		<button type="submit" class="btn btn-primary">
			<span class="fas fa-save" aria-hidden="true"></span> Guardar</button>

		</form>

		<a href="{{ route('rrhh.authorities.index') }}" class="btn btn-outline-secondary">Cancelar</a>

		<form method="POST" action="{{ route('rrhh.authorities.destroy', $authority) }}" class="d-inline">
			@csrf
            @method('DELETE')
			<button class="btn btn-danger float-right"><span class="fas fa-trash" aria-hidden="true"></span> Eliminar</button>
		</form>

	</fieldset>

</form>
@endcan

@endsection

@section('custom_js')

@endsection
