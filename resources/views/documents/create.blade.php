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

<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/create_doc.js') }}"></script>

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
        <div class="form-group col-lg-2">
            <label for="forType">Tipo*</label>
            <select name="type" id="formType" class="form-control" required>
                <option value="">Seleccione tipo</option>
                <option value="Memo" @if($document->type == 'Memo') selected @endif>Memo</option>
                <option value="Oficio" @if($document->type == 'Oficio') selected @endif>Oficio</option>
                <!-- <option value="Ordinario" @if($document->type == 'Ordinario') selected @endif>Ordinario</option> -->
                <option value="Reservado" @if($document->type == 'Reservado') selected @endif>Reservado</option>
                <option value="Circular" @if($document->type == 'Circular') selected @endif>Circular</option>
                <option value="Acta de recepción" @if($document->type == 'Acta de recepción') selected @endif>Acta de recepción</option>
                <option value="Resolución" @if($document->type == 'Resolución') selected @endif>Resolución</option>
            </select>
        </div>
        <div class="form-group col-lg-6">
            <label for="for_antecedent">Antecedente</label>
            <input type="text" class="form-control" id="for_antecedent" name="antecedent"
                placeholder="[opcional]"
                {!! $document->antecedent ? 'value="' . $document->antecedent .'"' : '' !!}>
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
<div id="collapse">
    <div class="form-row">
        <div class="form-group col-lg-7">
            <div class="form-group ">
                <label for="forFrom">De:*</label>
                <input type="text" class="form-control" id="forFrom" name="from"
                    placeholder="Nombre/Funcion" required
                    {!! $document->from ? 'value="' . $document->from .'"' : '' !!}>
            </div>
            <div class="form-group ">
                <label for="forFor">Para:*</label>
                <input type="text" class="form-control" id="forFor" name="for"
                    placeholder="Nombre/Funcion" required
                    {!! $document->for ? 'value="' . $document->for .'"' : '' !!}>
            </div>
            <div class="form-group">
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
    </div>
</div>

    <div class="form-group pt-1" style="width: 940px;">
        <label for="contenido">Contenido*</label>
        <textarea class="form-control" id="contenido" rows="18" name="content">{!! $document->content !!}</textarea>
    </div>
    <hr>

    @livewire('documents.add-email-text-area-list')

    <div class="form-group">
        <button type="submit" class="btn btn-primary mr-4">Guardar</button>
    </div>
</form>


@endsection

@section('custom_js')

<script type="text/javascript">

function validate_form()
{
    tinymce.triggerSave();
    validity = true;
    if (document.forms["form"]["content"].value.length == 0)
        { validity = false; alert('El "Contenido" no puede estar vacío'); }
    return validity;
};

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$('#formType').change(
    function() {
        $("#collapse").show();
        $("#forSubject").val(null);
        tinyMCE.activeEditor.setContent('');
        if("Memo" === this.value) {
            $("#forNumber").prop('disabled', false);
        }
        if("Oficio" === this.value) {
            $("#forNumber").prop('disabled', true);
            $("#forNumber").val(null);
        }
        if("Ordinario" === this.value) {
            $("#forNumber").prop('disabled', true);
            $("#forNumber").val(null);
        }
        if("Reservado" === this.value) {
            $("#forNumber").prop('disabled', true);
            $("#forNumber").val(null);
        }
        if("Circular" === this.value) {
            $("#forNumber").prop('disabled', false);
            $("#forFrom").removeAttr( "required" );
            $("#forFor").removeAttr( "required" );
            $("#forNumber").prop('disabled', true);
            $("#collapse").hide();
        }
        if("Acta de recepción" === this.value) {
            var contenido = '<h1 style="text-align: center; text-decoration: underline;">ACTA DE ENTREGA</h1> <p><strong>Datos de ubicación</strong></p> <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="2"> <tbody> <tr> <td style="width: 30%; height: 30px;">Establecimiento</td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Dirección</td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Unidad Organizacional</td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Ubicación (oficina)</td> <td></td> </tr> </tbody> </table> <p><strong>Características de la especie</strong></p> <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="2"> <tbody> <tr> <td style="width: 30%; height: 30px;">Inventario </td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Tipo de equipo</td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Marca</td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Modelo</td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Número de serie</td> <td></td> </tr> </tbody> </table> <p><strong>Responsable</strong></p> <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="2"> <tbody> <tr> <td style="width: 30%; height: 30px;">Nombre completo</td> <td></td> </tr> <tr> <td style="width: 30%; height: 30px;">Función / cargo</td> <td></td> </tr> </tbody> </table>';
            tinyMCE.activeEditor.setContent(contenido);
        }
        if("Resolución" === this.value) {
            $("#forFrom").removeAttr( "required" );
            $("#forFor").removeAttr( "required" );
            $("#forNumber").prop('disabled', true);
            $("#collapse").hide();
            $("#forSubject").val('Exenta');
        }
    }
);

</script>

@endsection
