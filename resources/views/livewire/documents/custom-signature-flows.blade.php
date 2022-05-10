<div>
    <div class="form-row">
        <fieldset class="form-group col-lg-6">
            <label for="for_url">Flujo de firmas</label>
            <select class="form-control"  name="customSignatureFlow_id" id="customSignatureFlow_id" wire:model.lazy="customSignatureFlow_id">
                <option value=""></option>
                @foreach($customSignatureFlows as $customSignatureFlow)
                    <option value="{{$customSignatureFlow->id}}">{{$customSignatureFlow->flow_name}}</option>
                @endforeach
            </select>
        </fieldset>

        @if($CustomSignatureFlow)
            <fieldset class="form-group col-lg-6">
                <label for="for_url"><br></label>
                <table class="table table-striped table-sm table-bordered">
                    @foreach($CustomSignatureFlow->signatories->sortBy('order') as $signatory)
                        <tr>
                            <td>{{$signatory->order}}</td>
                            <td>{{$signatory->signator->getFullNameAttribute()}}</td>
                            <td>{{$signatory->signator->organizationalUnit->name}}</td>
                        </tr>
                    @endforeach
                </table>
            </fieldset>
        @endif
    </div>
</div>
