<div class="form-row">
    <fieldset class="form-group col-lg-6">
        <label>Firmante - Unidad Organizacional*</label>
        <div wire:ignore>
            <select name="ou_id_signer" id="for_ou_id_signer" title="Seleccione una unidad firmante" wire:model="organizationalUnit" class="form-control selectpicker" data-live-search="true" data-size="5" required>
                <option value=''></option>
                @foreach($ouRoots as $ouRoot)
                    <option value="{{ $ouRoot->id }}">
                        {{ $ouRoot->name }}
                    </option>
                    @foreach($ouRoot->childs as $child_level_1)
                        <option value="{{ $child_level_1->id }}">
                            &nbsp;&nbsp;&nbsp;
                            {{ $child_level_1->name}}
                        </option>
                        @foreach($child_level_1->childs as $child_level_2)
                            <option value="{{ $child_level_2->id }}">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ $child_level_2->name}}
                            </option>
                            @foreach($child_level_2->childs as $child_level_3)
                                <option value="{{ $child_level_3->id }}">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $child_level_3->name}}
                                </option>
                                @foreach($child_level_3->childs as $child_level_4)
                                    <option value="{{ $child_level_4->id }}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ $child_level_4->name}}
                                    </option>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach

            </select>
        </div>
    </fieldset>
    @if(count($users) > 0)
        <fieldset class="form-group col-lg-6">
            <label>Firmante - Usuario</label>
            <select name="user_signer" id="for_user_signer" wire:model="user" class="form-control" {{$userRequired}} >
                <option value=''></option>
                @foreach($users as $user)
                    <option value={{ $user->id }}>{{ $user->fullName }}</option>
                @endforeach
            </select>
        </fieldset>
    @endif
</div>
