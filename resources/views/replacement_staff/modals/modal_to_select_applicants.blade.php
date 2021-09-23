<!-- Modal -->
<div class="modal fade" id="exampleModal-to-select-applicants" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Selección de Postulante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Postulantes a cargo(s)</h6>
                <form method="POST" class="form-horizontal" action="{{ route('replacement_staff.request.technical_evaluation.applicant.update_to_select', $applicant) }}">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                        <thead class="text-center small">
                            <tr>
                              <th style="width: 22%">Nombre</th>
                              <th style="width: 22%">Calificación Evaluación Psicolaboral</th>
                              <th style="width: 22%">Calificación Evaluación Técnica y/o de Apreciación Global</th>
                              <th style="width: 22%">Observaciones</th>
                              <th style="width: 2%"></th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @foreach($technicalEvaluation->applicants->sortByDesc('score') as $applicant)
                            <tr class="{{ ($applicant->selected == 1)?'table-success':''}}">
                                <td>{{ $applicant->replacement_staff->FullName }}</td>
                                <td class="text-center">{{ $applicant->psycholabor_evaluation_score }} <br> {{ $applicant->PsyEvaScore }}</td>
                                <td class="text-center">{{ $applicant->technical_evaluation_score }} <br> {{ $applicant->TechEvaScore }}</td>
                                <td>{{ $applicant->observations }}</td>
                                <td>
                                  <fieldset class="form-group">
                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="applicant_id[]"
                                              value="{{ $applicant->id }}">
                                      </div>
                                  </fieldset>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>

                    <div class="form-row">
                        <fieldset class="form-group col-3">
                            <label for="for_start_date">Desde</label>
                            <input type="date" class="form-control" name="start_date"
                              id="for_start_date" required>
                        </fieldset>
                        <fieldset class="form-group col-3">
                            <label for="for_end_date">Hasta</label>
                            <input type="date" class="form-control" name="end_date"
                              id="for_end_date" required>
                        </fieldset>
                        <fieldset class="form-group col-sm-6">
                            <label for="for_place_of_performance">Lugar de Desempeño</label>
                            <input type="text" class="form-control" name="place_of_performance" id="for_rplace_of_performance" value="{{ $applicant->place_of_performance }}">
                        </fieldset>
                    </div>
                    <div class="form-row">
                        <fieldset class="form-group col">
                            <label for="for_replacement_reason">Motivo de Reemplazo</label>
                            <input type="text" class="form-control" name="replacement_reason" id="for_replacement_reason" value="{{ $applicant->replacement_reason }}">
                        </fieldset>
                    </div>

                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Guardar</button>
                </form>
                <br><br>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>