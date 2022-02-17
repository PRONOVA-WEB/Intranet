@extends('layouts.app')

@section('title', 'Lista de Comunas')

@section('content')

@include('parameters/nav')

<h3 class="mb-3">Comunas
    {{-- 15/02/2022 vr agrego boton crear --}}
    <a class="btn btn-primary mb-3" href="{{ route('parameters.communes.create') }}">Crear</a></h3>
    {{-- 15/02/2022 vr agrego boton crear --}}
</h3>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($communes as $commune)
            <tr>
                <td>{{ $commune->id }}</td>
                <td>{{ $commune->name }}</td>
                <td>
                    <button class="btn btn-default" data-toggle="modal"
                        data-target="#editModal"
                        data-name="{{ $commune->name }}"
                        data-formaction="{{ route('parameters.communes.update', $commune->id)}}">
                    <i class="fas fa-edit"></i></button>
                    {{-- 14/02/2022 vr agrego boton eliminar --}}
                    <a href="#" class="delete" data-id="{{ $commune->id }}" data-href="{{ route('parameters.communes.destroy', $commune->id) }}" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash text-gray-600" title="Eliminar Comuna"></i></a>
                    {{-- 14/02/2022 vr agrego boton eliminar --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- 14/02/2022 vr agrego boton eleiminar --}}
{{-- modal confirm --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2>¿Desea eliminar la Comuna?</h2>
            </div>
            <div class="modal-footer">
                <form id="form-delete" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="setting" id="setting">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btn-ok">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('custom_js')
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            console.log($(e.relatedTarget).data('href'));
            $('#setting').val($(e.relatedTarget).data('id'));
            $('#form-delete').attr('action', $(e.relatedTarget).data('href'));
            //$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@endsection
{{-- 14/02/2022 vr agrego boton eleiminar --}}

@include('parameters/communes/modal_edit')

@endsection

@section('custom_js')
<script type="text/javascript">
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this)

        var name = button.data('name')
        modal.find('.modal-title').text('Editando ' + name)
        modal.find('input[name="name"]').val(name)

        var formaction  = button.data('formaction')
        modal.find("#form-edit").attr('action', formaction)
    })
</script>
@endsection
