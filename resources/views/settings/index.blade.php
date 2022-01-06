@extends('layouts.app')

@section('title', 'Parámetros')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Parámetros
            @can('Users: create')
				<a href="{{ route('settings.create') }}" class="btn btn-primary">Crear</a>
			@endcan
        </h1>
    </div>

    <div class="row">

@foreach($settings as $setting)

<div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 ">
            <h6 class="m-0 font-weight-bold">{{ $setting->display_name }}</h6>            <code>{{ $setting->key }}</code>
            <div class="float-right">
                <i class="fas fa-edit text-gray-600"></i>
                <i class="fas fa-trash text-gray-600"></i>
            </div>
        </div>
        <div class="card-body">
            @if ($setting->type == "text")
            <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
            @elseif($setting->type == "text_area")
            <textarea class="form-control" name="{{ $setting->key }}">{{ $setting->value ?? '' }}</textarea>
            @elseif($setting->type == "rich_text_box")
            <textarea class="form-control richTextBox" name="{{ $setting->key }}">{{ $setting->value ?? '' }}</textarea>
            @endif
        </div>
    </div>
</div>

@endforeach

@endsection

@section('custom_js')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
tinymce.init({
    selector:'.richTextBox',
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
</script>
@endsection
