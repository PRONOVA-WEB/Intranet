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
        <div class="form-group col-lg-8">
            <label for="for_antecedent">Antecedente</label>
            <input type="text" class="form-control" id="for_antecedent"
                placeholder="[opcional]"
                value="{{ $document->antecedent }}" name="antecedent">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-12">
            <label for="forSubject">Materia*</label>
            <input type="text" class="form-control" id="forSubject"
                value="{{ $document->subject }}" name="subject" maxlength="255"
                placeholder="Descripción del contenido del documento" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-7">
            <label for="forFrom">De:*</label>
            <input type="text" class="form-control" id="forFrom"
                value="{{ $document->from }}" name="from"
                placeholder="Nombre/Funcion" >
        </div>
        <div class="form-group col-lg-7">
            <label for="forFor">Para:*</label>
            <input type="text" class="form-control" id="forFor" name="for"
                value="{{ $document->for }}" placeholder="Nombre/Funcion">
        </div>
        <div class="form-group col-lg-7">
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

    @livewire('documents.doc-templates', ['document'=>$document])

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
