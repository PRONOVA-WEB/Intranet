@extends('layouts.app')

@section('title', 'Nuevo documento')

@section('content')

@include('documents.partials.nav')

<h3>Nuevo Documento</h3>

<form class="form-inline float-right" method="POST" action="{{ route('documents.createFromPrevious') }}">
    @csrf
    <label class="my-1 mr-2" for="forDocumentID">Crear a partir del </label>
    <input name="document_id" type="text" class="form-control mr-3" id="forDocumentID" placeholder="Código Interno">
    <button type="submit" class="btn btn-outline-secondary my-1"> <i class="fas fa-search"></i> Precargar</button>
</form>

<br><br>
<hr>

<form method="post" name="form" action="{{ route('documents.store') }}" onsubmit="return validate_form()">
    @csrf

    <div class="form-row">
        <div class="form-group col-lg-2">
            <label for="forNumber">Número</label>
            <input type="text" class="form-control" id="forNumber" name="number"
                placeholder="Asignado automático">
        </div>
        <div class="form-group col-lg-2">
            <label for="forDate">Fecha</label>
            <input type="date" class="form-control" id="forDate" name="date" value="{{\Carbon\Carbon::now()->toDateString()}}">
        </div>
        <div class="form-group col-lg-6">
            <label for="for_antecedent">Antecedente</label>
            <input type="text" class="form-control" id="for_antecedent" name="antecedent"
                placeholder="[opcional]"
                {!! $document->antecedent ? 'value="' . $document->antecedent .'"' : '' !!}>
        </div>
        <div class="form-group form-check-inline">
            <input type="checkbox" class="form-check-input" id="private" value="1" name="private">
            <label class="form-check-label" for="private">Privado</label>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-12">
            <label for="forSubject">Materia*</label>
            <input type="text" class="form-control" id="forSubject" name="subject"
                placeholder="Descripción del contenido del documento" required maxlength="255"
                {!! $document->subject ? 'value="' . $document->subject .'"' : '' !!}>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-7">
            <label for="forFrom">De:*</label>
            <input type="text" class="form-control" id="forFrom" name="from"
                placeholder="Nombre/Funcion" required
                {!! $document->from ? 'value="' . $document->from .'"' : '' !!}>
        </div>
        <div class="form-group col-lg-7">
            <label for="forFor">Para:*</label>
            <input type="text" class="form-control" id="forFor" name="for"
                placeholder="Nombre/Funcion" required
                {!! $document->for ? 'value="' . $document->for .'"' : '' !!}>
        </div>
        <div class="form-group col-lg-7">
            Mayor jerarquía:
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="greater_hierarchy" id="forHierarchyFrom" value="from" checked>
                <label class="form-check-label" for="forHierarchyFrom">DE:</label>
            </div>
            <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="greater_hierarchy" id="forHierarchyFor" value="for">
                    <label class="form-check-label" for="forHierarchyFor">PARA:</label>
            </div>
        </div>
    </div>

    @livewire('documents.doc-templates')

    @livewire('documents.add-email-text-area-list')

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-4">Guardar</button>
    </div>
</form>


@endsection

@section('custom_js')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/create_doc.js') }}"></script>
<script type="text/javascript">

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

</script>

@endsection
