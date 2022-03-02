@extends('layouts.app')

@section('title', 'Lista de Cargos')

@section('content')

@include('parameters/nav')

<h3 class="mb-3">Cargos
    {{-- 15/02/2022 vr agrego boton crear --}}
    <a class="btn btn-primary mb-3" href="{{ route('parameters.positions.create') }}">Crear</a></h3>
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
        @foreach($positions as $position)
            <tr>
                <td>{{ $position->id }}</td>
                <td>{{ $position->name }}</td>
                <td>
                    <button class="btn btn-default" data-toggle="modal"
                        data-target="#editModal"
                        data-name="{{ $position->name }}"
                        data-formaction="{{ route('parameters.positions.update', $position->id)}}">
                    <i class="fas fa-edit"></i></button>
                    {{-- 14/02/2022 vr agrego boton eliminar --}}
                    <a href="#" class="delete" data-id="{{ $position->id }}" data-href="{{ route('parameters.positions.destroy', $position->id) }}" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash text-gray-600" title="Eliminar Cargo"></i></a>
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
                <h2>¿Desea eliminar Cargo?</h2>
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


@endsection

@section('custom_js')

@include('parameters/positions/modal_edit')

<script type="text/javascript">
    //14/02/2022 vr agrego boton eleiminar
    $('#confirm-delete').on('show.bs.modal', function(e) {
        console.log($(e.relatedTarget).data('href'));
        $('#setting').val($(e.relatedTarget).data('id'));
        $('#form-delete').attr('action', $(e.relatedTarget).data('href'));
        //$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    //14/02/2022 vr agrego boton eleiminar

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
