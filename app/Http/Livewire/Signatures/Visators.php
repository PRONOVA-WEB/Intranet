<?php

namespace App\Http\Livewire\Signatures;

use Livewire\Component;
use App\Rrhh\OrganizationalUnit;
use App\User;

class Visators extends Component
{
    public $organizationalUnit;
    public $users = [];
    public $inputs = [];
    public $i = 0;
    public $user;
    public $signature;
    public $showList;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
        $this->showList = (!empty($this->inputs)) ? '' : 'd-none';
//        $this->i--;
//        if ($this->i === 0) {
//            $this->endorseType = '';
//        }
    }

//    public function changeEndorseType()
//    {
//        if ($this->endorseType === 'No requiere visación' || $this->endorseType == '') {
//            $this->disabledAddButton = 'disabled';
//            $this->requiredVisator = '';
//            for ($i = 0; $i <= $this->i; $i++) {
//                $this->remove($i);
//            }
//            $this->i = 0;
//
//        } elseif($this->endorseType === 'Visación opcional' || $this->endorseType === 'Visación en cadena de responsabilidad'){
//            $this->disabledAddButton = '';
//            if ($this->i == 0) {
//                $this->add($this->i);
//            }
//            $this->requiredVisator = 'required';
//        }
//    }

    public function mount()
    {
        $this->showList = 'd-none';
        //Agrega inputs según cantidad de flows de visator al editar
        if ($this->signature && $this->signature->signaturesFlowVisator->count() > 0) {
            for ($i = 0; $i < $this->signature->signaturesFlowVisator->count(); $i++) {
                $this->add($this->i);
            }
        }

        // Agrega unidad organizacional al editar
        if ($this->signature && $this->signature->signaturesFlowVisator->count() > 0) {
            foreach ($this->inputs as $key => $value) {
                $this->organizationalUnit[$value] = $this->signature->signaturesFlowVisator->slice($key, 1)->first()->ou_id;
            }
        }

        //Agrega los usuarios según unidad organizacional, si se está editando, selecciona el usuario
        foreach ($this->inputs as $key => $value) {
            if (!empty($this->organizationalUnit[$value])) {
                $this->users[$value] = OrganizationalUnit::find($this->organizationalUnit[$value])->users;
                //Si se está editando
                if ($this->signature) {
                    $this->user[$value] = $this->signature->signaturesFlowVisator->slice($key, 1)->first()->user_id;
                }

            }
        }
    }

    public function render()
    {
        //Agrega los usuarios según unidad organizacional
        foreach ($this->inputs as $key => $value) {
            if (!empty($this->organizationalUnit[$value])) {
                $this->users[$value] = OrganizationalUnit::find($this->organizationalUnit[$value])->users;
            }
            $this->showList = '';
        }

        return view('livewire.signatures.visators')
            ->withOuRoots(OrganizationalUnit::where('level', 1)->where('establishment_id', 1)->get());
    }
}
