@extends('layouts.app')

@section('title', 'Permisos')

@section('content')

@include('parameters/nav')

@if ($guard == 'web')
<h3 class="mb-3">Permisos Internos</h3>
@else
<h3 class="mb-3">Permisos Externos</h3>
@endif


<a class="btn btn-primary mb-3" href="{{ route('parameters.permissions.create', $guard) }}">Crear</a>

<table class="table table-responsive table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Guard</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->description }}</td>
            <td>{{ $permission->guard_name }}</td>
            <td>
                <a href="{{ route('parameters.permissions.edit', $permission->id )}}">
                <i class="fas fa-edit"></i>
                </a>
                {{-- 17/02/2022 vr agrego boton eliminar --}}
                {{-- <a href="#" class="delete" data-id="{{ $permission->id }}" data-href="{{ route('parameters.permissions.destroy', $permission->id) }}" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash text-gray-600" title="Eliminar Permiso"></i></a> --}}
                {{-- 17/02/2022 vr agrego boton eliminar --}}

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- 17/02/2022 vr agrego boton eleiminar --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2>¿Desea eliminar Permiso?</h2>
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
{{-- 17/02/2022 vr agrego boton eleiminar --}}

@endsection

@section('custom_js')

@endsection
