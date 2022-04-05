<?php

namespace App\Http\Livewire\Rrhh;

use Livewire\Component;

class DeleteShiftButton extends Component
{
    public $actuallyShiftUserDay;
    public $actuallyYear;
    public $actuallyMonth;

    public function render()
    {
        return view('livewire.rrhh.delete-shift-button');
    }
    public function deleteActually(){
        $this->emit("setDataToDeleteModal",[$this->actuallyShiftUserDay,$this->actuallyYear,$this->actuallyMonth]);

    }
}
