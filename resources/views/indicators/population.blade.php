@extends('layouts.app')

@section('title', 'Reporte de población')

@section('content')
<h4 class="mb-3"><i class="fas fa-chart-pie"></i> Tablero de Población</h4>

<div class="card">
	  <div class="card-body">
				<form method="GET" class="form-horizontal" action="{{ route('indicators.population') }}">

				<div class="form-row">
						<fieldset class="form-group col-sm-2">
								<label>Fuente</label>
								<select class="form-control selectpicker show-tick" name="type" required>
										<option value="">Selección...</option>
										<option value="Definitivo" @if($request->type == "Definitivo") selected @endif>Definitivo</option>
										<option value="Preliminar"@if($request->type == "Preliminar") selected @endif>Preliminar</option>
								</select>
						</fieldset>

	    			@livewire('indicators.dashboard.population-search-form', ['request' => $request])

						<fieldset class="form-group col-sm-2">
			        <label>Género</label>
			        <select class="form-control selectpicker" name="gender_id[]" data-actions-box="true" multiple required>
			          <option value="M" @if($request->type!= NULL && in_array('M', $request->gender_id)) selected @endif>Masculino</option>
			          <option value="F" @if($request->type!= NULL && in_array('F', $request->gender_id)) selected @endif>Femenino</option>
								<option value="I" @if($request->type!= NULL && in_array('I', $request->gender_id)) selected @endif>Otro</option>
			        </select>
			      </fieldset>

						<fieldset class="form-group col-9 col-md-2">
				        <label>Grupos etários</label>
				        <select class="form-control selectpicker" name="etario_id[]" data-actions-box="true" title="Seleccione..." multiple required>
										@foreach(range(0, 99) as $edad) {
										    <option value="{{ $edad }}" @if($request->type!= NULL && in_array($edad, $request->etario_id)) selected @endif>{{$edad}}</option>
										@endforeach
										<option value=">=100" @if($request->type!= NULL && in_array('>=100', $request->etario_id)) selected @endif>100 y más</option>
				        </select>
			      </fieldset>
				</div>

				<button type="submit" class="btn btn-primary float-right"><i class="fas fa-chart-pie"></i> Consultar</button>

				</form>
	  </div>
</div>

<br>

@if($request->has('type') && $total_pob->count() > 0)
		<h4>Total población: <b>{{ number_format($total_pob->sum('valor'),0,",",".") }}</b></h4>

		<div class="row">
		    <div class="col-sm-12">
		      <div id="chart_establishments" ></div>
		    </div>
		</div>

		<br>

		<div class="row">
					<div class="col-sm-6">
						<div id="chart_communes" ></div>
					</div>


			    <div class="col-sm-6">
			      <div id="piechart"></div>
			    </div>
		</div>

		<br>

		<div class="row">
				<div class="col-sm-12">
						<div id="chart_div"></div>
				</div>
		</div>
		
@elseif($request->has('type') && $total_pob->count() == 0)

	<div class="row">
			<div class="col-sm-12">
					<div class="alert alert-secondary" role="alert">
						  Estimado Usuario: se informa que no se encontró población en nuestros registros, favor cambiar criterios de busqueda.
					</div>
			</div>
	</div>

@else

@endif


@endsection

@section('custom_js_head')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
	@if($request->type != NULL)
      google.charts.load('current', {'packages':['corechart','line']});
      google.charts.setOnLoadCallback(drawChartEstablisments);
      google.charts.setOnLoadCallback(drawChartCommunes);
			google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawStacked);


      function drawChartEstablisments() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Establecimiento');
          data.addColumn('number', 'Población');
          // data.addColumn('number', 'Mujeres');
          data.addRows([

							@php($total_pob_group = $total_pob->groupBy($request->type == 'Definitivo' ? 'Centro_APS' : 'Nombre_Centro')->all())

							@foreach($total_pob_group as $key => $pob)
                ['{{ $key }}',{{ $pob->sum('valor') }}],
              @endforeach
          ]);

          var options = {
              title: 'Población por establecimientos',
              curveType: 'log',
              // width: 380,
              height: 400,
              colors: ['#3366CC', '#CC338C'],
              legend: { position: 'bottom' },
              backgroundColor: '#f8fafc',
              chartArea: {'width': '85%', 'height': '80%'},
              hAxis: {
                  textStyle : {
                      fontSize: 9 // or the number you want
                  },
                  textPosition: '50',
              },
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('chart_establishments'));

          chart.draw(data, options);
      }


      function drawChartCommunes() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Establecimiento');
          data.addColumn('number', 'Cantidad');
          // data.addColumn('number', 'Mujeres');
          data.addRows([

							@php($total_pob_group = $total_pob->groupBy($request->type == 'Definitivo' ? 'Comuna' : 'comuna')->all())
              @foreach($total_pob_group as $key => $pob)
                ['{{ $key }}',{{ $pob->sum('valor') }}],
              @endforeach
          ]);

          var options = {
              title: 'Población por comunas',
              curveType: 'log',
              // width: 380,
              height: 400,
              colors: ['#FF5733', '#CC338C'],
              legend: { position: 'bottom' },
              backgroundColor: '#f8fafc',
              chartArea: {'width': '85%', 'height': '80%'},
              hAxis: {
                  textStyle : {
                      fontSize: 9 // or the number you want
                  },
                  textPosition: '50',
              },
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('chart_communes'));

          chart.draw(data, options);
      }

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Género', 'Cantidad'],
					@php($total_pob_group = $total_pob->groupBy($request->type == 'Definitivo' ? 'Sexo' : 'GENERO')->all())
          @foreach($total_pob_group as $key => $pob)
            ['{{ $key }}',    {{ $pob->sum('valor') }}],
          @endforeach
        ]);

        var options = {
          title: 'Población por género',
          height: 400,
					backgroundColor: '#f8fafc',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

			function drawStacked() {
        var data = google.visualization.arrayToDataTable([
          ['Edad', 'Cantidad'],
					@php($total_pob_group = $total_pob->groupBy('Edad')->all())
          @foreach($total_pob_group as $key => $pob_x_etario)
            ['{{ $key }}', {{$pob_x_etario->sum('valor') }}],
          @endforeach
        ]);

        var options = {
					title: 'Población por edad',
					curveType: 'log',
					// width: 380,
					height: 400,
					colors: ['#3366CC', '#CC338C'],
					legend: { position: 'bottom' },
					backgroundColor: '#f8fafc',
					chartArea: {'width': '85%', 'height': '80%'},
					hAxis: {
							textStyle : {
									fontSize: 9 // or the number you want
							},
							textPosition: '50',
					},
        };
				var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
	@endif
</script>

@endsection
