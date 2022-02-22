<select class="form-control selectpicker"
    id="{{ $selected_id }}"
    name="{{ $selected_id }}"
    required title="Seleccione una unidad"  data-live-search="true">

    <option></option>
    @if($ouRoot)
        @include('livewire.organizational_unit_childs', ['ou' => $ouRoot])
    @else
        @foreach($ouRoots as $ouRoot)
            @include('livewire.organizational_unit_childs', ['ou' => $ouRoot])
            <option></option>
        @endforeach
    @endif
</select>
