@extends('layouts.app')

@section('title', 'Solicitud')

@section('content')

@include('replacement_staff.nav')

<div class="card">
    <div class="card-header">
        Formulario Solicitud Contratación de Personal
    </div>
    <div class="card-body">

        <form method="POST" class="form-horizontal" action="{{ route('replacement_staff.request.update', $requestReplacementStaff) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <fieldset class="form-group col-4">
                    <label for="for_name">Nombre de Cargo</label>
                    <input type="text" class="form-control" name="name"
                        id="for_name" value="{{ $requestReplacementStaff->name }}" required>
                </fieldset>

                @livewire('replacement-staff.show-profile-request', ['requestReplacementStaff' => $requestReplacementStaff])

                <fieldset class="form-group col-2">
                    <label for="for_start_date">Desde</label>
                    <input type="date" class="form-control" name="start_date"
                        id="for_start_date" value="{{ $requestReplacementStaff->start_date->format('Y-m-d')  }}" required>
                </fieldset>

                <fieldset class="form-group col-2">
                    <label for="for_end_date">Hasta</label>
                    <input type="date" class="form-control" name="end_date"
                        id="for_end_date" value="{{ $requestReplacementStaff->end_date->format('Y-m-d')  }}" required>
                </fieldset>
            </div>

            <div class="form-row">
                @livewire('replacement-staff.show-legal-quality-request', ['requestReplacementStaff' => $requestReplacementStaff])
            </div>

            <div class="form-row">
                <fieldset class="form-group col-6">
                    <label for="for_calidad_juridica">Jornada</label>
                    <div class="mt-1">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="work_day" id="for_work_day_diurnal" value="diurnal"
                              {{ ($requestReplacementStaff->work_day == "diurnal")? "checked" : "" }} required>
                          <label class="form-check-label" for="for_work_day_diurnal">Diurno</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="work_day" id="for_work_day_third_shift" value="third shift"
                              {{ ($requestReplacementStaff->work_day == "third_shift")? "checked" : "" }} required>
                          <label class="form-check-label" for="for_work_day_third_shift">Tercer Turno</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="work_day" id="for_work_day_fourth_shift" value="fourth shift"
                              {{ ($requestReplacementStaff->work_day == "fourth_shift")? "checked" : "" }} required>
                          <label class="form-check-label" for="for_work_day_fourth_shift">Cuarto Turno</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="work_day" id="for_work_day_other" value="other"
                              {{ ($requestReplacementStaff->work_day == "other")? "checked" : "" }} required>
                          <label class="form-check-label" for="for_work_day_other">Otro</label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-group col-4">
                    <label for="for_name">Otra Jornada</label>
                    <input type="text" class="form-control" name="other_work_day"
                        id="for_other_work_day" placeholder="Otro" value="{{ $requestReplacementStaff->other_work_day }}">
                </fieldset>

                <fieldset class="form-group col-2">
                    <label for="for_charges_number">Nº Cargos</label>
                    <input type="number" class="form-control" name="charges_number"
                        id="for_charges_number" placeholder="Otro" value="{{ $requestReplacementStaff->charges_number }}">
                </fieldset>
            </div>

            <div class="form-row">
                <fieldset class="form-group col-md-6">
                    <div class="mb-3">
                      <label for="for_job_profile_file" class="form-label">Perfil de Cargo</label>
                      <input class="form-control" type="file" name="job_profile_file"
                          accept="application/pdf">
                    </div>
                </fieldset>
                @if($requestReplacementStaff->job_profile_file)
                <div class="col-1">
                    <p>&nbsp;</p>
                    <a href="{{ route('replacement_staff.request.show_file', $requestReplacementStaff) }}" class="btn btn-outline-secondary btn-sm" title="Ir" target="_blank"> <i class="far fa-eye"></i></a>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('replacement_staff.request.download', $requestReplacementStaff) }}" target="_blank"><i class="fas fa-download"></i>
                    </a>
                </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Guardar</button>

        </form>
    </div>
</div>

@endsection

@section('custom_js')

<script type="text/javascript">
    document.getElementById('for_other_work_day').readOnly = true;

    // NAME Option
    $("input[name=work_day]").click(function() {
        switch(this.value){
            case "other":
                document.getElementById('for_other_work_day').readOnly = false;
                break;
            default:
                document.getElementById('for_other_work_day').readOnly = true;
                document.getElementById('for_other_work_day').value = '';
                break;
        }
    });
</script>

<script type="text/javascript">

    document.getElementById('for_name_to_replace').readOnly = true;
    document.getElementById('for_other_fundament').readOnly = true;

    jQuery('select[name=fundament]').change(function(){
        var fieldsetName = $(this).val();
        switch(this.value){
            case "replacement":
                document.getElementById('for_name_to_replace').readOnly = false;

                document.getElementById('for_other_fundament').readOnly = true;
                document.getElementById('for_other_fundament').value = '';
                break;
            case "quit":
                document.getElementById('for_name_to_replace').readOnly = false;

                document.getElementById('for_other_fundament').readOnly = true;
                document.getElementById('for_other_fundament').value = '';
                break;

            case "allowance without payment":
                document.getElementById('for_name_to_replace').readOnly = false;

                document.getElementById('for_other_fundament').readOnly = true;
                document.getElementById('for_other_fundament').value = '';
                break;

            case "other":
                document.getElementById('for_name_to_replace').readOnly = true;
                document.getElementById('for_name_to_replace').value = '';

                document.getElementById('for_other_fundament').readOnly = false;
                break;
            default:
                document.getElementById('for_name_to_replace').readOnly = true;
                document.getElementById('for_name_to_replace').value = '';

                document.getElementById('for_other_fundament').readOnly = true;
                document.getElementById('for_other_fundament').value = '';
                break;
        }
    });
</script>

@endsection
