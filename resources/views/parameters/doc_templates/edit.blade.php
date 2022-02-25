@extends('layouts.app')

@section('title', 'Editar plantilla de documentos')

@section('content')

@include('parameters/nav')

<h3 class="mb-3">Editar plantilla de documentos</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.documents_templates.update', $docTemplate) }}">
    @csrf
    @method('PUT')

    <div class="form-row">

        <fieldset class="form-group col-lg-3">
            <label for="for_type">Tipo*</label>
            <input type="text" class="form-control" id="for_type" name="type" required value="{{ $docTemplate->type }}">
        </fieldset>
        <fieldset class="form-group col-lg-6">
            <label for="for_description">Descripción*</label>
            <input type="text" class="form-control" id="for_description" name="description" required value="{{ $docTemplate->description }}">
        </fieldset>
        <fieldset class="form-group col-lg-3">
            <label for="for_status">Estatus*</label><br>
            <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="status" {{ ($docTemplate->status == 'ACTIVA') ? 'checked' : '' }} value="active">Activa
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="status" {{ ($docTemplate->status == 'INACTIVA') ? 'checked' : '' }} value="inactive">Inactiva
                </label>
              </div>
        </fieldset>
        <fieldset class="form-group col-lg-12">
            <label for="for_body">Cuerpo del documento*</label>
            <textarea class="form-control" id="contenido" rows="18" name="body">{!! $docTemplate->body !!}</textarea>
        </fieldset>

    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a class="btn btn-outline-secondary" href="{{ route('parameters.documents_templates.index') }}">Volver</a>

</form>

@endsection

@section('custom_js')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/create_doc.js') }}"></script>
@endsection
