@php
    $nameTextArea = isset($signature) ? 'recipients' : 'responsible';
    $forTextArea  = isset($signature) ? 'for_recipients' : 'forResponsible';
@endphp
<div class="bg-gray-200 p-4 mb-3">
    <h3>Añadir a listas</h3>
    <div class="form-row">
        <fieldset class="form-group col-lg-5">
            <label>Unidad Organizacional</label>
            <select name="ou_id_signer" id="for_ou_id_signer" wire:model="organizationalUnit" class="form-control " data-live-search="true" data-size="5">
                <option value=''></option>

                @foreach($ouRoots as $ouRoot)
                    <option value="{{ $ouRoot->id }}">
                        {{ $ouRoot->name . ' - ' . $ouRoot->establishment->alias }}
                    </option>
                    @foreach($ouRoot->childs as $child_level_1)
                        <option value="{{ $child_level_1->id }}">
                            &nbsp;&nbsp;&nbsp;
                            {{ $child_level_1->name  . ' - ' . $ouRoot->establishment->alias}}
                        </option>
                        @foreach($child_level_1->childs as $child_level_2)
                            <option value="{{ $child_level_2->id }}">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ $child_level_2->name  . ' - ' . $ouRoot->establishment->alias}}
                            </option>
                            @foreach($child_level_2->childs as $child_level_3)
                                <option value="{{ $child_level_3->id }}">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $child_level_3->name  . ' - ' . $ouRoot->establishment->alias}}
                                </option>
                                @foreach($child_level_3->childs as $child_level_4)
                                    <option value="{{ $child_level_4->id }}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ $child_level_4->name  . ' - ' . $ouRoot->establishment->alias}}
                                    </option>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach

            </select>
        </fieldset>
        @if(count($users) > 0)
            <fieldset class="form-group col-lg-4">
                <label>Usuario</label>
                <select name="user_signer" id="for_user_signer" wire:model="user" class="form-control">
                    <option value=''></option>
                    @foreach($users as $user)
                        <option value={{ $user->id }}>{{ $user->fullName }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="form-group col-lg-3">
                <button class="btn btn-success btn-sm my-3" wire:click='addToList({{ $this->user }}, "distribution")' type="button">Añadir a distribución</button>
                <button class="btn btn-success btn-sm" wire:click='addToList({{ $this->user }}, "{{ $nameTextArea }}")' type="button">Añadir como {{ ($signature) ? 'destinatario' : 'responsable'}}</button>
            </fieldset>
        @endif
    </div>
    <div class="form-row mt-2">
        <div class="form-group col">
            <label for="forDistribution">Distribución {{ isset($signature) ? 'del documento' : '' }} (separado por salto de línea)</label>
            <textarea class="form-control" id="forDistribution" rows="6" wire:model='distribution' name="distribution"></textarea>
        </div>

        <div class="form-group col">
            <label for="{{ $forTextArea }}">{{ isset($signature) ? 'Destinatarios del documento' : 'Responsables' }} (separado por salto de línea)</label>
            <textarea class="form-control" id="{{ $forTextArea }}" rows="6" wire:model='{{ $nameTextArea }}' name="{{ $nameTextArea }}"></textarea>
        </div>
    </div>
</div>
