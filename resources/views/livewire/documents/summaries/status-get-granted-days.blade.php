<div class="form-row">
    <div class="form-group col-lg-3">
        <label for="for_antecedent">Tipo</label>
        <select class="form-control" name="status_id" wire:model.lazy="status_id">
          <option value=""></option>
          @foreach($summaryStatus as $status)
            <option value="{{$status->id}}">{{$status->name}}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group col-lg-2">
        <label for="forDate">Días otorgados</label>
        <input type="text" class="form-control" id="forDate" name="granted_days" value="{{$granted_days}}">
    </div>
</div>
