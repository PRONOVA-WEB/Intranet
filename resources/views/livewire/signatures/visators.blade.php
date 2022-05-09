<div>
    <div class="form-row">
        <fieldset class="form-group col-lg-4">
            <label for="for_endorse_type">Tipo de visación</label>
            <select class="form-control" name="endorse_type" required>
                <option value="">Seleccione tipo de visación</option>
                @php($endorseTypes = ['No requiere visación', 'Visación opcional', 'Visación en cadena de responsabilidad'])
                @foreach ($endorseTypes as $endorseType)
                    <option value="{{ $endorseType }}" @if (isset($signature) && $signature->endorse_type == $endorseType) selected @endif>
                        {{ $endorseType }}
                    </option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="form-group col-lg-2">
            <label for="">&nbsp;</label>
            <button class="btn text-white btn-info btn-block" wire:click.prevent="add({{ $i }})"> <i
                    class="fa fa-user-plus"></i> Agregar Visador</button>
        </fieldset>

        <fieldset class="form-group offset-lg-3 col-lg-3">
            <label for=""></label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="visatorAsSignature" id="for_visatorAsSignature"
                    value="1">
                <label class="form-check-label" for="for_visatorAsSignature">Visadores como firmantes</label>
                <small id="presumend_help" class="form-text text-muted">
                    Si se selecciona, los usuarios visadores pasarán a ser firmantes. Igualmente se debe seleccionar un
                    usuario en firmante. </small>
            </div>
        </fieldset>

    </div>
    <div class="form-row {{ $showList }}">
        <div class="col-lg-5">
            <label for="">Unidad Organizacional</label>
        </div>
        <div class="col-lg-5">
            <label for="">Visador</label>
        </div>
    </div>
    @foreach ($inputs as $key => $value)
        <div class="form-row">
            <fieldset class="form-group col-lg-5">
                <div wire:ignore>
                    <select name="ou_id_visator[]" wire:model="organizationalUnit.{{ $value }}"
                        class="form-control selectpicker" title="Seleccione una unidad para visado" data-live-search="true" data-size="5">
                        <option value=''></option>
                        @foreach ($ouRoots as $ouRoot)
                            <option value="{{ $ouRoot->id }}">
                                {{ $ouRoot->name }}
                            </option>
                            @foreach ($ouRoot->childs as $child_level_1)
                                <option value="{{ $child_level_1->id }}">
                                    &nbsp;&nbsp;&nbsp;
                                    {{ $child_level_1->name }}
                                </option>
                                @foreach ($child_level_1->childs as $child_level_2)
                                    <option value="{{ $child_level_2->id }}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ $child_level_2->name }}
                                    </option>
                                    @foreach ($child_level_2->childs as $child_level_3)
                                        <option value="{{ $child_level_3->id }}">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $child_level_3->name }}
                                        </option>
                                        @foreach ($child_level_3->childs as $child_level_4)
                                            <option value="{{ $child_level_4->id }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $child_level_4->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </fieldset>
            <fieldset class="form-group col-lg-5">
                @if (array_key_exists($value, $users))
                    @if(count($users[$value]) > 0)
                    <select name="user_visator[]" wire:model="user.{{ $value }}" class="form-control" {{$requiredVisator}}>
                        <option value=''></option>
                        @foreach ($users[$value] as $user)
                            <option value={{ $user->id }}>{{ $user->fullName }}</option>
                        @endforeach
                    </select>
                    @endif
                @endif
            </fieldset>
            <fieldset class="form-group col-lg-2">
                <button class="btn btn-danger btn-block"
                    wire:click.prevent="remove({{ $key }})">Remover</button>
            </fieldset>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (message, component) => {
            if (message.updateQueue[0].method === 'add') {
                $('.selectpicker').selectpicker('refresh');
            }
        })
    });
</script>