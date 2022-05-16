@extends('layouts.app')

@section('title', 'Solicitud de firma y distribución')

@section('content')

    <h3>Nueva solicitud de firmas y distribución</h3>

    <form method="POST" action="{{ route('documents.signatures.store') }}" enctype="multipart/form-data" onsubmit="disableButton(this)">
        @csrf

        @if(isset($document))
            <input type="hidden" name="document_id" value="{{$document->id}}">
        @endif

        @if(isset($signature->agreement_id))
            <input type="hidden" name="agreement_id" value="{{$signature->agreement_id}}">
            <input type="hidden" name="signature_type" value="{{$signature->type}}">
        @endif

        @if(isset($signature->addendum_id))
            <input type="hidden" name="addendum_id" value="{{$signature->addendum_id}}">
            <input type="hidden" name="signature_type" value="{{$signature->type}}">
        @endif

        @if(isset($xAxis) && isset($yAxis))
            <input type="hidden" name='custom_x_axis' value="{{$xAxis}}">
            <input type="hidden" name='custom_y_axis' value="{{$yAxis}}">
        @endif

        <div class="form-row">

            <fieldset class="form-group col-lg-3">
                <label for="for_request_date">Fecha Documento*</label>
                <input type="date" class="form-control" id="for_request_date" name="request_date"
                       value="{{isset($signature) ? $signature->request_date->format('Y-m-d') : ''}}" required>
            </fieldset>
        </div>

        <div class="form-row">

            <fieldset class="form-group col-lg-3">
                <label for="for_document_type">Tipo de Documento*</label>
                @if (isset($document))
                    <input type="text" class="form-control" readonly name="document_type" value="{{ $document->template->type }}">
                @else
                    <select class="form-control" name="document_type" required>
                        <option value="">Seleccione tipo</option>
                        @foreach($docTypes as $docType)
                            <option value="{{$docType}}"
                                    @if(isset($signature) && $docType == $signature->document_type) selected @endif>{{$docType}}</option>
                        @endforeach
                    </select>
                @endif

            </fieldset>

            <fieldset class="form-group col-lg-9">
                <label for="for_subject">Materia o tema del documento*</label>
                <input type="text" class="form-control" id="for_subject" name="subject"
                       value="{{isset($signature) ? $signature->subject : ''}}" required>
            </fieldset>

        </div>

        <div class="form-row">
            <fieldset class="form-group col-lg-12">
                <label for="for_description">Descripción del documento*</label>
                <input type="text" class="form-control" id="for_description" name="description"
                       value="{{isset($signature) ? $signature->description : ''}}" required>
            </fieldset>
        </div>

        <div class="form-row">
            <fieldset class="form-group col-lg-6">

                @if(isset($signature) && $signature->signaturesFileDocument->file != null)
                    <button name="id" class="btn btn-link" form="showPdf" formtarget="_blank">
                        <i class="fas fa-paperclip"></i> Documento
                    </button>
                    <input type="hidden" name="file_base_64" value="{{  $signature->signaturesFileDocument->file }}">
                    <input type="hidden" name="document" form="showPdf" value="{{  $document->id }}">
                    <input type="hidden" name="file_base_64"  value="{{  $signature->signaturesFileDocument->file}}"
                           form="showPdf">
                    <input type="hidden" name="md5_file" value="{{$signature->signaturesFileDocument->md5_file}}">
                @else
                    <label for="for_document">Documento a distribuir* </label>
                    <input type="file" class="form-control" id="for_document" name="document" accept="application/pdf" required>
                    <small class="form-text text-muted">Tamaño máximo 5 MB | Formato .PDF</small>
                @endif

            </fieldset>

            <fieldset class="form-group col-lg-6">
                <label for="for_annexed">Anexos</label>
                <input type="file" class="form-control" id="for_annexed" name="annexed[]" multiple>
            </fieldset>
        </div>

        <div class="form-row">
            <fieldset class="form-group col-lg-12">
                <label for="for_url">Link o URL asociado</label>
                <input type="url" class="form-control" id="for_url" name="url"
                       value="{{isset($signature) ? $signature->url : ''}}" >
            </fieldset>
        </div>

        <h6>Gestión de Firmas</h6>
        <input type="radio" id="firmante" name="tipo_firma" value="firmante" checked>
        <label for="firmante">Firmante</label>
        <input type="radio" id="flujo_firmas" name="tipo_firma" value="flujo_firmas">
        <label for="flujo_firmas">Flujo de firmas</label><br>
        <br>
        @if(isset($signature) && isset($signature->type))
            @if($signature->type == 'visators')
            @livewire('signatures.visators', ['signature' => $signature])
            @endif
        @else
            @livewire('signatures.visators')
        @endif
        <hr>

        @if(isset($signature) && isset($signature->type))
            @if($signature->type == 'visators')

            @else
                <div id="div_firmante">@livewire('signatures.signer', ['signaturesFlowSigner' => $signature->signaturesFlowSigner])</div>
                <div id="div_flujo" style="display: none">@livewire('documents.custom-signature-flows',['customSignatureFlows'=>$customSignatureFlows])</div>
            @endif
        @else
            <div id="div_firmante">@livewire('signatures.signer')</div>
            <div id="div_flujo" style="display: none">@livewire('documents.custom-signature-flows',['customSignatureFlows'=>$customSignatureFlows])</div>
        @endif
        <hr>

        @livewire('documents.add-email-text-area-list', ['document'=>$document ?? '','signature'=>$signature ?? ''])

        <button type="submit" id="submitBtn" class="btn btn-primary" onclick="disableButton(this)"> <i class="fa fa-file"></i> Crear Solicitud</button>

    </form>

    <form method="POST" id="showPdf" name="showPdf" action="{{ route('documents.signatures.showPdfFromFile')}}">
        @csrf
    </form>

@endsection

@section('custom_js')

    <script type="text/javascript">

$("#firmante").change(function() {
            $("#div_firmante").show();
            $("#div_flujo").hide();
            $("#for_ou_id_signer").prop('required',true);
            $("#customSignatureFlow_id").prop('required',false);
            $("#addVisatorBtn").removeClass('d-none');
            $("[name='endorse_type']").val('Visación en cadena de responsabilidad').prop('disabled',false);
        });
        $("#flujo_firmas").change(function() {
            $("#div_firmante").hide();
            $("#div_flujo").show();
            $("#for_ou_id_signer").prop('required',false);
            $("#customSignatureFlow_id").prop('required',true);
            $("#addVisatorBtn").addClass('d-none');
            $("[name='endorse_type']").val('Visación en cadena de responsabilidad').prop('disabled',true);
        });
        function disableButton(form) {
            form.submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Creando...';
            form.submitBtn.disabled = true;
            return true;
        }

        $('#for_document').bind('change', function() {
            //Validación de tamaño
            if((this.files[0].size / 1024 / 1024) > 5){
                alert('No puede cargar un pdf de mas de 5 MB.');
                $('#for_document').val('');
            }

            //Validación de pdf
            const allowedExtension = ".pdf";
            let hasInvalidFiles = false;

            for (let i = 0; i < this.files.length; i++) {
                let file = this.files[i];

                if (!file.name.endsWith(allowedExtension)) {
                    hasInvalidFiles = true;
                }
            }

            if(hasInvalidFiles) {
                $('#for_document').val('');
                alert("Debe seleccionar un archivo pdf.");
            }

        });

    </script>

@endsection
