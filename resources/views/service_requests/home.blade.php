@extends('layouts.app')

@section('title', 'Contratación Honorarios')

@section('content')

@include('service_requests.partials.nav')

<div class="row mt-3">
    <h1 class="display-6">Contratación de Honorarios</h1>
</div>


@endsection

@section('custom_js')
<script>
$('a[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'top',
    html: true
});
</script>
@endsection
