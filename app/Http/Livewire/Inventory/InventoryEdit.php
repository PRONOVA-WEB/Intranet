<?php

namespace App\Http\Livewire\Inventory;

use App\Http\Requests\Inventory\UpdateInventoryRequest;
use App\Models\Establishment;
use App\Models\Inv\Inventory;
use Livewire\Component;

class InventoryEdit extends Component
{
    public $inventory;
    public $establishment;

    public $number_inventory;
    public $useful_life;
    public $status;
    public $depreciation;
    public $brand;
    public $model;
    public $serial_number;
    public $observations;

    public function render()
    {
        return view('livewire.inventory.inventory-edit')
            ->extends('layouts.app');
    }

    public function mount(Inventory $inventory, Establishment $establishment)
    {
        $this->inventory = $inventory;

        $this->number_inventory = $this->inventory->number;
        $this->useful_life = $this->inventory->useful_life;
        $this->status = ($this->inventory->status === null) ? '1' : $this->inventory->status;
        $this->depreciation = $this->inventory->depreciation;
        $this->brand = $this->inventory->brand;
        $this->model = $this->inventory->model;
        $this->serial_number = $this->inventory->serial_number;
        $this->observations = $this->inventory->observations;
    }

    public function rules()
    {
        return (new UpdateInventoryRequest($this->inventory))->rules();
    }

    public function update()
    {
        $dataValidated = $this->validate();

        $dataValidated['number'] = $dataValidated['number_inventory'];
        $this->inventory->update($dataValidated);

        session()->flash('success', 'El item del inventario fue editado exitosamente.');
        return redirect()->route('inventories.pending-inventory', $this->establishment);
    }
}
