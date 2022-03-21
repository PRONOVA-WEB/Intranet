@extends('layouts.app')

@section('title', 'Editar sumario')

@section('content')

<h3>Editar Sumario</h3>

<!-- <form method="post" name="form" action="{{ route('documents.store') }}" onsubmit="return validate_form()">
    @csrf -->

    <div class="form-row">
        <div class="form-group col-lg-2">
            <label for="forNumber">ID</label>
            <input type="text" class="form-control" id="forNumber" name="number" value="13" disabled>
        </div>
        <div class="form-group col-lg-2">
            <label for="forNumber">Nro Resolución</label>
            <input type="text" class="form-control" id="forNumber" name="number" value="3355" disabled>
        </div>
        <div class="form-group col-lg-2">
            <label for="forDate">Fecha</label>
            <input type="date" class="form-control" id="forDate" name="date" value="{{\Carbon\Carbon::now()->toDateString()}}" disabled>
        </div>
        <div class="form-group col-lg-3">
            <label for="for_antecedent">Tipo</label>
            <select class="form-control" name="" disabled>
              <option value="">Sumario administrativo</option>
              <option value="" selected>Investigación sumaria</option>
            </select>
        </div>
        <div class="form-group col-lg-3">
            <label for="for_antecedent">Fiscal</label>
            <select class="form-control" name="" disabled>
              <option value="">Juan Carlos Pérez</option>
              <option value="" selected>Luis Flores</option>
              <option value="">Otro Otro</option>
            </select>
        </div>
    </div>
    <!-- <div class="form-row">
        <fieldset class="form-group col-12 col-md-6">
        </fieldset>

        <fieldset class="form-group col-12 col-md-6">
            <label for="forFile">Adjuntar archivos</label>
            <input type="file" class="form-control-file" id="forfile" name="forfile[]" multiple>
        </fieldset>
    </div> -->
    <div class="form-group col-lg-12">
        <label for="for_antecedent">Materia</label>
        <textarea class="form-control" name="textarea" rows="5" disabled>
          Phasellus dolor est, vestibulum id condimentum id, ornare nec orci. Morbi eget nisl viverra, accumsan lorem nec, cursus ligula. Duis quis luctus eros, posuere pretium orci. Nunc blandit rhoncus enim a iaculis. Sed at lectus feugiat magna suscipit maximus. Proin eu nibh ornare odio blandit commodo ac pellentesque elit. Vivamus odio diam, accumsan in aliquet vel, efficitur eu magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse sit amet justo vitae augue vehicula scelerisque quis eu mi. Fusce ultrices odio id arcu cursus, ut varius leo rutrum. Sed vel malesuada risus, a fermentum ex. Vivamus in lectus vitae nulla pharetra cursus. Cras mattis velit et felis lobortis, at imperdiet nisi rhoncus. Maecenas porttitor dictum odio in ultrices. Nunc et ante enim.
        </textarea>
    </div>

<!-- </form> -->

    <hr>
    <h4>Eventos</h4>

    <div class="mb-3">
    	<a class="btn btn-primary"
    		href="{{ route('documents.summaries.events.create') }}">
    		<i class="fas fa-shopping-cart"></i> Nuevo evento
    	</a>
    </div>

    <div class="table-responsive">
      <table class="card-table table table-sm table-bordered">
          <thead>
            <tr>
              <th scope="col">Fecha</th>
              <th scope="col">Tipo</th>
              <th scope="col">Funcionario</th>
              <th scope="col">Unidad/Departamento</th>
              <th>Observaciones</th>
              <th>Días otorgados</th>
              <th>Días pasados</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>01/01/2020 08:55</td>
              <td>Apertura</td>
              <td>Carmen aguilar</td>
              <td>Departamento jurídico Hospital Santiago</td>
              <td></td>
              <td>5</td>
              <td>3</td>
              <td></td>
            </tr>
            <tr>
              <td>05/01/2020 08:36</td>
              <td>Notificación al fiscal</td>
              <td>Carmen aguilar</td>
              <td>Departamento jurídico Hospital Santiago</td>
              <td>Blandit varius dolor sit, im congue tempor.</td>
              <td>8</td>
              <td>3</td>
              <td></td>
            </tr>
            <tr>
              <td>07/01/2020 12:33</td>
              <td>Formalización de cargos</td>
              <td>Carmen aguilar</td>
              <td>Departamento jurídico Hospital Santiago</td>
              <td></td>
              <td>3</td>
              <td>3</td>
              <td></td>
            </tr>
            <tr>
              <td>09/01/2020 13:01</td>
              <td>Cierre de sumario</td>
              <td>Carmen aguilar</td>
              <td>Departamento jurídico Hospital Santiago</td>
              <td>Donec faucibus ante sed enim congue tempor. Quisque blandit varius dolor sit amet euismod.</td>
              <td>3</td>
              <td>1</td>
              <td></td>
            </tr>
          </tbody>
      </table>
      </div>

      <!-- apertura - notificación al fiscal - formulación de cargos - solicita sobreseimiento - prorroga - cerrar el sumario reapertura. -->


@endsection

@section('custom_js')

@endsection
