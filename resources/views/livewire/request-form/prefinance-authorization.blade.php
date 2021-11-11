<div>
    <div class="table-responsive">
      <h6><i class="fas fa-info-circle"></i> Lista de Bienes y/o Servicios</h6>
      <table class="table table-condensed table-hover table-bordered table-sm small">
          <thead>
              <tr>
                  <th>Item</th>
                  <th>ID</th>
                  <th>Item Pres.</th>
                  <th>Artículo</th>
                  <th>UM</th>
                  <th>Especificaciones Técnicas</th>
                  <th>Archivo</th>
                  <th>Cantidad</th>
                  <th>Valor U.</th>
                  <th>Impuestos</th>
                  <th>Total Item</th>
              </tr>
          </thead>
          <tbody>
            @foreach($requestForm->itemRequestForms as $key => $item)
              <tr>
                  <td class="text-center">{{$key+1}}</td>
                  <td class="text-center">{{$item->id}}</td>
                  <td>
                      <select  wire:model.defer="arrayItemRequest.{{ $item->id }}.budgetId"  wire:click="resetError" class="form-control form-control-sm" required>
                          <option value="">Seleccione...</option>
                          @foreach($lstBudgetItem as $val)
                            <option value="{{$val->id}}">{{$val->code.' - '.$val->name}}</option>
                          @endforeach
                      </select>
                  </td>
                  <td>{{$item->article}}</td>
                  <td>{{$item->unit_of_measurement}}</td>
                  <td>{{$item->specification}}</td>
                  <td>FILE</td>
                  <td>{{$item->quantity}}</td>
                  <td>{{$item->unit_value}}</td>
                  <td>{{$item->tax}}</td>
                  <td>{{$item->expense}}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="5" rowspan="2"></td>
                  <td colspan="3">Cantidad de Items</td>
                  <td colspan="3">{{count($requestForm->itemRequestForms)}}</td>
              </tr>
              <tr>
                  <td colspan="3">Valor Total</td>
                <td colspan="3">{{$requestForm->estimated_expense}}</td>
              </tr>
          </tfoot>
      </table>
      @error('arrayItemRequest') <span class="error text-danger">{{ $message }}</span> @enderror
      
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-signature"></i></a> Autorización Refrendación Presupuestaria
            </div>
            <div class="card-body">
                <div class="form-row">
                    <fieldset class="form-group col-sm-5">
                        <label for="forRut">Responsable:</label>
                        <input wire:model="userAuthority" name="userAuthority" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>

                    <fieldset class="form-group col-sm-2">
                        <label>Cargo:</label><br>
                        <input wire:model="position" name="position" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>

                    <fieldset class="form-group col-sm-5">
                        <label for="forRut">Unidad Organizacional:</label>
                        <input wire:model="organizationalUnit" name="organizationalUnit" class="form-control form-control-sm" type="text" readonly>
                    </fieldset>
                </div>
                <div class="form-row">
                    <fieldset class="form-group col-sm-6">
                        <label for="forRut">Folio Requerimiento SIGFE:</label>
                        <input wire:model="sigfe" name="sigfe" wire:click="resetError" class="form-control form-control-sm" type="text">
                        @error('sigfe') <span class="error text-danger">{{ $message }}</span> @enderror
                    </fieldset>

                    <fieldset class="form-group col-sm-6">
                      <label>Programa Asociado:</label><br>
                      <input wire:model="program" name="program" wire:click="resetError" class="form-control form-control-sm" type="text">
                      @error('program') <span class="error text-danger">{{ $message }}</span> @enderror
                    </fieldset>
                </div>



                <div class="form-row">
                    <fieldset class="form-group col-sm-12">
                        <label for="forRejectedComment">Comentario de Rechazo:</label>
                        <textarea wire:model="rejectedComment" wire:click="resetError" name="rejectedComment" class="form-control form-control-sm" rows="3"></textarea>
                        @error('rejectedComment') <span class="error text-danger">{{ $message }}</span> @enderror
                        </fieldset>
                </div>

                <div class="row justify-content-md-end mt-0">
                    <div class="col-2">
                        <button type="button" wire:click="acceptRequestForm" class="btn btn-primary btn-sm float-right">Autorizar</button>
                    </div>
                    <div class="col-1">
                        <button type="button" wire:click="rejectRequestForm" class="btn btn-secondary btn-sm float-right">Rechazar</button>
                    </div>
                </div>
            </div>
        </div>

</div>
