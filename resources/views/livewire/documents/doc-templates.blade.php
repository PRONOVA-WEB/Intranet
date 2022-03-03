<div class="form-row">
    <div class="form-group col-lg-7">
        <label for="forType">Tipo*</label>
        <select name="doc_templates_id" id="doc_templates_id" wire:change="$emit('typeChange',$event.target.value)" name="doc_templates_id" class="form-control" required>
            <option>Seleccione</option>
            @foreach ($docTemplates as $docTemplate)
            <option value="{{ $docTemplate->id }}" @if ($document)
                {{ ($docTemplate->id == $document->doc_templates_id) ? 'selected' : '' }}
            @endif>{{ $docTemplate->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-lg-12">
        <label for="contenido">Contenido*</label>
        @if ($document)
        <button type="button" class="btn btn-sm btn-secondary float-right" wire:click='resetContent({{ $document->id }})'>Descartar Cambios</button>
        @endif
        <textarea class="form-control" id="contenido" rows="18" wire:model="content" name="content">{!! $document->content ?? '' !!}></textarea>
    </div>
    <hr>
    <script type="text/javascript">
        window.addEventListener('tinyCharge', e => {
            tinymce.init({
                selector:'#contenido',
                language: 'es_MX',
                theme: 'modern',
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table directionality emoticons template paste textcolor'
                ],
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | removeformat ',
                browser_spellcheck: true
            });
        })
      </script>
</div>
