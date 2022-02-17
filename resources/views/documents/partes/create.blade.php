@extends('layouts.app')

@section('title', 'Ingreso de documentos')

@section('content')

@include('documents.partes.partials.nav')

<h3 class="mb-3">Ingreso de parte</h3>

<form method="POST" class="form" action="{{ route('documents.partes.store')}}" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div class="form-row">
        <fieldset class="form-group col-lg-3">
            <label for="for_entered_at">Fecha Ingreso*</label>
            <input type="datetime-local" class="form-control" id="for_entered_at"
                name="entered_at" required>
        </fieldset>

        <fieldset class="form-group col-lg-3">
            <label for="for_date">Fecha Documento*</label>
            <input type="date" class="form-control" id="for_date"name="date" required>
        </fieldset>

        <fieldset class="form-group col-lg-3">
            <label for="for_type">Tipo*</label>
            <select name="type" id="for_type" class="form-control" required>
                <option value="Carta">Carta</option>
                <option value="Circular">Circular</option>
                <option value="Decreto">Decreto</option>
                <option value="Demanda">Demanda</option>
                <option value="Informe">Informe</option>
                <option value="Memo">Memo</option>
                <option value="Oficio">Oficio</option>
                <option value="Ordinario">Ordinario</option>
                <option value="Otro">Otro</option>
                <option value="Permiso Gremial">Permiso Gremial</option>
                <option value="Reservado">Reservado</option>
                <option value="Resolucion">Resolución</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-lg-2">
            <label for="for_number">Número</label>
            <input type="text" class="form-control" id="for_number" name="number">
        </fieldset>

        <fieldset class="form-group col-lg-1">
            <label for="for_important">&nbsp;</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="important" id="for_important" value="1">
                    <label class="form-check-label" for="for_important">Importante</label>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="form-row">
        <fieldset class="form-group col-lg-12">
            <label for="for_orign">Origen*</label>
            <input type="text" class="form-control" id="for_orign" name="origin" required>
            <small id="emailHelp" class="form-text text-muted">Desde donde viene el documento.</small>
        </fieldset>
        <fieldset class="form-group col-lg-12">
            <label for="for_subject">Asunto*</label>
            <input type="text" class="form-control" id="for_subject" name="subject" required>
        </fieldset>
    </div>
    <div class="form-row">
        <fieldset class="form-group col-lg-6">
            <!--<label for="for_file">Archivo</label>-->
            <div class="custom-file">
                <label for="forFile">Adjuntar</label>
                <input type="file" class="form-control-file" id="forfile" name="forfile[]" multiple required>
                <small class="form-text text-muted">Tamaño máximo 5 MB | Formatos .PDF, .PNG, .JPG, .DOC, .DOCX, .XLS, .XLSX | Puede cargar varios archivos</small>
            </div>
        </fieldset>
        <fieldset class="form-group col-lg-6">
            <label for="for_physical_format">&nbsp;</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="physical_format" id="for_physical_format" value="1">
                    <label class="form-check-label" for="for_physical_format">Requiere documento físico al derivar</label>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="form-row">
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </div>
</form>
@endsection
