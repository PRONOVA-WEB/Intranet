@extends('layouts.app')

@section('title', 'Crear Unidad Organizacional')

@section('content')

<h3>Crear nueva unidad organizacional - {{Auth::user()->organizationalUnit->establishment->name}}</h3>

<form method="POST" class="form-horizontal" action="{{ route('rrhh.organizational-units.store') }}">
	{{ csrf_field() }}
    <input type="hidden" class="form-control" id="forEstablishment"
				name="establishment_id" required="required" value="{{Auth::user()->organizationalUnit->establishment->id}}">
	<div class="row">
		<fieldset class="form-group col-lg-12">
			<label for="forName">Nombre*</label>
			<input type="text" class="form-control" id="forName"
				placeholder="Nombre de la unidad organizacional" name="name" required="required">
		</fieldset>
	</div>

	<div class="row">
		<fieldset class="form-group col-lg-9">
			<label for="forFather">Depende de*</label>
			<select class="form-control selectpicker" id="forFather" name="father">
				<option value="{{ $organizationalUnit->id }}">
	            {{ $organizationalUnit->name }}
	            </option>
	            @foreach($organizationalUnit->childs as $child_level_1)
	                <option value="{{ $child_level_1->id }}">
	                &nbsp;&nbsp;&nbsp;
	                {{ $child_level_1->name }}
	                </option>
	                @foreach($child_level_1->childs as $child_level_2)
	                    <option value="{{ $child_level_2->id }}">
	                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                    {{ $child_level_2->name }}
	                    </option>
	                    @foreach($child_level_2->childs as $child_level_3)
	                        <option value="{{ $child_level_3->id }}">
	                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                            {{ $child_level_3->name }}
	                        </option>
							@foreach($child_level_3->childs as $child_level_4)
								<option value="{{ $child_level_4->id }}">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									{{ $child_level_4->name }}
								</option>
								@foreach($child_level_4->childs as $child_level_5)
									<option value="{{ $child_level_5->id }}">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										{{ $child_level_5->name }}
									</option>
								@endforeach
							@endforeach
	                    @endforeach
	                @endforeach
	            @endforeach
			</select>
		</fieldset>

		<fieldset class="form-group col-lg-3">
			<label for="forLevel">Nivel*</label>
			<input type="number" class="form-control" id="forLevel"
				name="level" required="required" min="1" max="4">
		</fieldset>
	</div>

	<div class="row">

	</div>

    <button type="submit" class="btn btn-primary">Crear</button>

    <a href="{{ route('rrhh.organizational-units.index') }}" class="btn btn-outline-dark">Cancelar</a>

</form>

@endsection
