@extends('layouts.app')

@section('title', 'Editar documento')

@section('content')

@include('documents.partials.nav')

<h3>Editar Documento</h3>

@if( Auth::id() == $document->user_id )

<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/create_doc.js') }}"></script>


<form method="POST" class="form-horizontal" action="{{ route('documents.update', $document) }}">
    @csrf
    @method('PUT')

    <div class="form-row">
        <div class="form-group col-lg-2">
            <label for="forNumber">Número</label>
            <input type="text" class="form-control" id="forNumber" name="number"
                value="{{ $document->number }}" readonly>
        </div>
        <div class="form-group col-lg-2">
            <label for="forDate">Fecha</label>
            <input type="date" class="form-control" id="forDate" name="date"
                value="{{ $document->date ? $document->date->format('Y-m-d') : '' }}">
        </div>
        <div class="form-group col-lg-2">
            <label for="forType">Tipo*</label>
            <select name="type" id="formType" class="form-control" required>
                <option value="Memo" {{ $document->type === 'Memo' ? 'selected' : '' }}>Memo</option>
                <option value="Oficio" {{ $document->type === 'Oficio' ? 'selected' : '' }}>Oficio</option>
                <option value="Ordinario" {{ $document->type === 'Ordinario' ? 'selected' : '' }} >Ordinario</option>
                <option value="Reservado" {{ $document->type === 'Reservado' ? 'selected' : '' }}>Reservado</option>
                <option value="Circular" {{ $document->type === 'Circular' ? 'selected' : '' }}>Circular</option>
                <option value="Acta de recepción" {{ $document->type === 'Acta de recepción' ? 'selected' : '' }}>Acta de recepción</option>
                <option value="Resolución" @if($document->type == 'Resolución') selected @endif>Resolución</option>
            </select>
        </div>
        <div class="form-group col">
            <label for="for_antecedent">Antecedente</label>
            <input type="text" class="form-control" id="for_antecedent"
                placeholder="[opcional]"
                value="{{ $document->antecedent }}" name="antecedent">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label for="forSubject">Materia*</label>
            <input type="text" class="form-control" id="forSubject"
                value="{{ $document->subject }}" name="subject" maxlength="255"
                placeholder="Descripción del contenido del documento" required>
        </div>
    </div>

<div id="collapse">
    <div class="form-row">
        <div class="form-group col-lg-7">
            <div class="form-group ">
                <label for="forFrom">De:*</label>
                <input type="text" class="form-control" id="forFrom"
                    value="{{ $document->from }}" name="from"
                    placeholder="Nombre/Funcion" >
            </div>
            <div class="form-group ">
                <label for="forFor">Para:*</label>
                <input type="text" class="form-control" id="forFor" name="for"
                    value="{{ $document->for }}" placeholder="Nombre/Funcion">
            </div>
            <div class="form-group">
                Mayor jerarquía:
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="greater_hierarchy"
                        id="forHierarchyFrom" value="from"
                        {{ $document->greater_hierarchy == 'from' ? 'checked' : ''}}>
                    <label class="form-check-label" for="forHierarchyFrom"> DE: </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="greater_hierarchy"
                        id="forHierarchyFor" value="for"
                        {{ $document->greater_hierarchy == 'for' ? 'checked' : ''}}>
                    <label class="form-check-label" for="forHierarchyFor"> PARA: </label>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="form-group pt-1" style="width: 940px;">
        <label for="contenido">Contenido*</label>
        <textarea class="form-control" id="contenido" rows="18"
            name="content">{{ $document->content }}</textarea>
    </div>

    {{-- <div class="form-row">
        <div class="form-group col">
            <label for="forDistribution">Distribución (separado por salto de línea)*</label>
            <textarea class="form-control" id="forDistribution" rows="5"
                name="distribution">{{ $document->distribution }}</textarea>
        </div>
        <div class="form-group col">
            <label for="forResponsible">Responsables (separado por salto de línea)</label>
            <textarea class="form-control" id="forResponsible" rows="5"  placeholder="Cargo"
                name="responsible">{{ $document->responsible }}</textarea>
        </div>
    </div> --}}

    @livewire('documents.add-email-text-area-list', ['document'=>$document])

    <div class="form-group">
        <button type="submit" class="btn btn-primary float-left">Guardar</button>
        </form>
        @can('Documents: delete document')
            @if(!$document->file OR $document->file_to_sign_id === null)
            <form method="POST" action="{{ route('documents.destroy', $document) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger float-right">Eliminar</button>
                <br>
            </form>
            @else
            <button class="btn btn-outline-danger" disable>No se puede eliminar, tiene un archivo o ha sido firmado</button>
            @endif
        @endcan
    </div>



@endif

@endsection

@section('custom_js')

<script type="text/javascript">
var typeVal = $('#formType').val();
    if(typeVal == "Resolución") {
        $("#forFrom").removeAttr( "required" );
        $("#forFor").removeAttr( "required" );
        $("#collapse").hide();
    }
$('#formType').change(
    function() {
        if(!confirm('Con este cambio se reemplazará el número actual que tiene asignado el documento por uno nuevo según el tipo de documento que seleccionaste, ¿Está seguro/a de realizar esto al momento de guardar los cambios?')){
            $(this).val(typeVal);
            return;
        }

        if("Resolución" === this.value) {
            $("#forFrom").removeAttr( "required" );
            $("#forFor").removeAttr( "required" );
            $("#collapse").hide();
        }



        $("#forNumber").val(null);
        // if("Memo" === this.value) {
        //     $("#forNumber").prop('disabled', false);
        // }
        // if("Ordinario" === this.value) {
        //     $("#forNumber").prop('disabled', true);
        //     $("#forNumber").val(null);
        // }
        // if("Reservado" === this.value) {
        //     $("#forNumber").prop('disabled', true);
        //     $("#forNumber").val(null);
        // }
        // if("Circular" === this.value) {
        //     $("#forNumber").prop('disabled', false);
        // }
    }



);
</script>

@endsection
