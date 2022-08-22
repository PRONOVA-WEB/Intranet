<?php

namespace App\Http\Livewire\Rrhh;

use Livewire\Component;
use \Illuminate\Session\SessionManager;
use App\Models\Rrhh\ShiftUser;
use Carbon\Carbon;
use App\Rrhh\OrganizationalUnit;
use App\Models\Rrhh\ShiftTypes;
use Session;

class ListOfShifts extends Component
{
	public $staffInShift;
	public $actuallyYear;
	public $actuallyMonth;
    public $actuallyOrgUnit;
    public $position;
	public $days;
    public $statusx;
    private $actuallyShift;
    public  $sTypes;
    private $colors = array(
            1 => "lightblue",
            2 => "#2471a3",
            3 => " #52be80 ",
            4 => "orange",
            5 => "#ec7063",
            6 => "#af7ac5",
            7 => "#f4d03f",
            8 => "gray",
            9  => "yellow",
            10  => "brown",
            11  => "brown",
            12  => "brown",
            13  => "brown",
            14  => "brown",
            15  => "lightred",
            16  => "lightbrown",
    );
    protected $listeners = ['refreshListOfShifts' => '$refreh'];

    public function init()
    {
        $this->loadData = true;
    }

    public function ref()  {

         // $this->reset();
        $this->emit("renderShiftDay");
        // $this->statusx++;
        // $this->render();
           // dd($id);
        // $this->mount($this->staffInShift,$this->actuallyYear,$this->actuallyMonth,$this->days);
        // $this->render();
        // $this->$refresh;/
    }

    public function mount($actuallyShift=null,$staffInShift=null)
    {

        $cargos = OrganizationalUnit::all();
        $sTypes = ShiftTypes::all();
        $actuallyYear = $this->actuallyYear ?? Carbon::now()->format('Y');
        $actuallyMonth = $this->actuallyMonth ?? Carbon::now()->format('m');
        $days = $this->days ?? Carbon::now()->daysInMonth;
        $actuallyOrgUnit = $this->actuallyOrgUnit ?? $cargos->first();

        $position = $this->position;

        $staffInShiftLocal = ShiftUser::where('organizational_units_id', $this->actuallyOrgUnit->id )
                    ->where('date_up','>=',$this->actuallyYear."-".$this->actuallyMonth."-01")
                    ->where('date_from','<=',$this->actuallyYear."-".$this->actuallyMonth."-".$this->days);

        if(!is_null($actuallyShift))
        {

            $this->actuallyShift = $actuallyShift ?? $this->actuallyShift=$sTypes->first();

            $staffInShiftLocal = $staffInShiftLocal->where('shift_types_id',$this->actuallyShift->id);
        }

        if(!is_null($position)) {
            $staffInShiftLocal->whereHas('user', function ($q) use ($position) {
                $q->where('position',$position);
            });
        }
        $this->staffInShift = $staffInShift ?? $staffInShiftLocal->get();

    }

    public function editShiftDay($id){

        // $this->emit('clearModal', $this->shiftDay->id);
        $this->filered ="on";
        // $this->emit('setshiftUserDay', $this->shiftDay->id);
        // $this->emit('setshiftUserDay', $id);


        // $this->shiftDay = ShiftUserDay::find($id);
        // $this->count++;
        // dd($this->shiftDay);
    }

    public function render()
    {
        return view('livewire.rrhh.list-of-shifts',["statusColors"=>$this->colors,"actuallyShift"=>$this->actuallyShift]);
    }

}
