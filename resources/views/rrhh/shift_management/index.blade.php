@extends('layouts.app')
@section('title', 'Gestion de Turnos')


@section('content')

<style type="text/css">
	:root {
    font-size: 16px;
}

.table {
    border: solid 2px black;
    white-space: nowrap;
}

.table thead th {
    text-align: center;
    vertical-align: middle;
    border-bottom: none;
    border: none;
}

.brless {
    /* border-right: solid 1px transparent !important; */
}

.bless {border: none !important;}
.br {border-right: solid 1px #454d55 !important;}
.dia {
    opacity: 0.8;
}

.day {
    background-color: white;
    text-align: center;
}

.night {
    background-color: rgba(0, 0, 0, 0.2);
    text-align: center;
    border-right-color: black !important;
}

.calendar-day {
    font-size: 2rem;
    text-align: center;
    padding: 0!important;
}

.table th, .table td {padding: 0.5rem !important;}

.borderBottom {
    border-bottom: solid 2px #454d55 !important;
}

.bbd {
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid 1px #454d55;
}

.bbn {
    border-top: none !important;
    border-left: none;
    border-right: solid 1px #454d55;
    border-bottom: solid 1px #454d55;
}
.bg-red {background-color: #ff5133;}
.bg-green {background-color: #00e63d;}
.bg-purple {background-color: #d57aff;}
.bg-red, .bg-green, .bg-purple {color: white;}

</style>
<div class="form-group" >
	<!-- <div class="col-lg-12"> -->
		<h3> Gestión de Turnos </h3>
		<form method="POST" class="form-horizontal shadow" action="{{ route('rrhh.shiftsTypes.store') }}">
			@csrf
    		@method('POST')
			<div class="row"> 
	
    		<div class="col-lg-3">
				<div class="input-group">
            	
            		<label for="for_name">CARGOS </label>
            		<select class="form-control" id="for_turnFilter" name="turnFilter">
            			<option>0 - Todos</option>
            			@foreach($cargos as $c)
            				<option value="{{$c->id}}">{{$loop->iteration}} - {{$c->name}} </option>
            			@endforeach
            		</select>
        	  	</div>
        	</div>
    		<div class=" col-lg-3">
				<div class="input-group">

            		<label for="for_name" class="input-group-addon">TURNOS </label>
            
            		<select class="form-control" id="for_turnFilter" name="turnFilter">
            			<option>1 - Todos</option>
            			@foreach($sTypes as $st)
            				<option value="{{$st->id}}">{{$loop->iteration}} - Solo {{$st->name}}</option>
            			@endforeach
            			<option value="99">99 - Solo Turno Personalizado</option>
            		</select>

        	  	</div>
        	</div>
        	<div class="col-lg-2">
				<div class="input-group">
            	
            		<label for="for_name">AÑO </label>
            		<select class="form-control" id="for_turnFilter" name="yearFilter">
            			@for($i = $actuallyYear; $i< (intval($actuallyYear) + 4); $i++)
            				<option value="{{$i}}"> {{$i}}</option>
            				
            			@endfor	
            		</select>
        	  	</div>
        	</div>
        	<div class="col-lg-2">
				<div class="input-group">
            	
            		<label for="for_name">MES </label>
            		<select class="form-control" id="for_turnFilter" name="turnFilter">
            			
            			@foreach($months AS $index => $month)
            				<option value="{{ $index }}" {{ ($index == $actuallyMonth )?"selected":"" }}>{{$loop->iteration}} - {{$month}}</option>
            			@endforeach
            			
            		</select>
        	  	</div>
        	</div>
        	<div class=" col-lg-1">
				<div class="input-group">
    				<button type="submit" class="btn btn-primary btn-xs">Filtrar</button>
    			</div>
        	</div>
        	<div class=" col-lg-1">
				<div class="input-group">
    				<button type="button" class="btn btn-outline-success btn-xs"><i class="fa fa-file-excel"></i></button>
    			</div>
        	</div>

</div>

		</form>


	<!-- </div> -->
</div>
<div class="row  shadow" style=" overflow: auto;white-space: nowrap;">
	<div class="col-md-2">
            <table class="table">
                <thead class="thead-dark">
                    <th rowspan="2">Personal</th>
                    <th class="br" rowspan="2">Turnos</th>
                		@for ($i = 1; $i <= $dias; $i++)
                            <th colspan="2" class="calendar-day">{{$i}}</th> 
                        @endfor

                        <tr>
                            @for($i = 1; $i <= $dias; $i++) 
                                    
                                    <th class="brless dia">🌞</th>
                                    <th class="noche">🌒</th>
                            @endfor
                        </tr>
                </thead>
                <tbody>
                    <?php
                        $personas = 12;
                        $nombre = "Nombre";
                        $turno = "Turno ABC";
                     
                    ?>
					@foreach($users as $user)
					<tr>
						
						   <td class="bless br"  rowspan="2">{{ $user->runFormat()}} - {{$user->name}}</td>
                           <td class="bless br "  rowspan="2"		>
                           	<select class="form-control">
                           		
                           		@foreach($sTypes as $st)
    								<fieldset class="form-group col-6 col-xs-6">
            							<option value="{{$st->id}}">
            								{{$loop->iteration}} - Solo {{$st->name}}
            							</option>
            						</fieldset>
            					@endforeach

                           	</select>	
                           </td>

						    @for($j = 1; $j <= $dias; $j++) 

						     	<td>	
                                   	<div class="bbd day">D</div>
						     	</td>	
						    	<td>	
                                    <div class="bbn night">N</div>
						     	</td>	
					
                                       
                            @endfor
							</tr>	
                            	<tr>	
						    @for($j = 1; $j <= $dias; $j++) 


										<td colspan="2">
                                		      <div  class="bbd day">L</div>
										</td>
                            @endfor
								</tr>	
                                        
                                        
 
					@endforeach
                   
                </tbody>
            </table>
    </div>
</div>

@endsection
@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<script type="text/javascript">
	var obj = {
  foo: 'bar'
}

Object.freeze(obj)

new Vue({
  el: '#app',
  data: obj
})
</script>
@endsection