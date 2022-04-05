<?php

namespace App\Http\Livewire\Rrhh;

use Livewire\Component;
use App\Models\Rrhh\ShiftUserDay;
use App\Models\Rrhh\ShiftUser;
use Session;
use Carbon\Carbon;


class DeleteShift extends Component
{
    protected $listeners = ['setDataToDeleteModal' => 'setValues'];
    public $startdate;
    public $enddate;
    public $ShiftUserDay;
    public $ShiftUser;
    public $actuallyGroup = "Sin grupo";
    public $cantDaysToDelete = 0 ;
    public $actuallyShift;
    public $userName;
    public $deleteAll = 0 ;
    public $rutUser;
    public $daysList= array();
    public $actuallyShiftUserDay;

    public function render()
    {
        return view('livewire.rrhh.delete-shift');
    }
    public function mount(){

       $this->cantDaysToDelete = 0;
       // $this->deleteAll = 1;
    }
    public function setValues($actuallyShiftDay){
        // $this->clearDeleteModal();
        // dd($actuallyShiftDay[0]["id"]);
        $this->ShiftUser = ShiftUser::find($actuallyShiftDay[0]["id"]);
        // dd($this->ShiftUser->user->getFullNameAttribute());
       $this->userName = $this->ShiftUser->user->getFullNameAttribute();
       $this->rutUser =  $this->ShiftUser->user->runFormat();
        $this->actuallyGroup =  htmlentities(Session::get('groupname'));
       $this->actuallyShift = $this->ShiftUser->shiftType;
       $this->actuallyShiftUserDay = Session::get('actuallyShift');

        $this->startdate =  $actuallyShiftDay[1]."-". $actuallyShiftDay[2] ."-01" ;
        $lastDayofMonth =    \Carbon\Carbon::parse($actuallyShiftDay[1]."-". $actuallyShiftDay[2] ."-01")->endOfMonth()->toDateString();

        $this->enddate =  $lastDayofMonth;
        $days =  (object) $this->ShiftUser->days;
        foreach ($days->where("day",">=",$this->startdate)->where("day","<=",$this->enddate) as $day) {
// dd(   $days );
        // foreach ($days as $day) {
        //     if($day->day >= $this->startdate && $day->day <= $this->enddate)
                array_push($this->daysList,$day);
        }
        $this->cantDaysToDelete = sizeof( $this->daysList );

    }
    public function changeDate(){
        $this->daysList= array();
        if($this->deleteAll == 0){

            $days =  (object) $this->ShiftUser->days;
            foreach ($days->where("day",">=",$this->startdate)->where("day","<=",$this->enddate) as $day) {
                array_push($this->daysList,$day);
            }
        }else{
            $days =  (object) $this->ShiftUser->days;
            foreach ($days as $day) {
                array_push($this->daysList,$day);
            }
        }
        $this->cantDaysToDelete = sizeof( $this->daysList );
    }

    public function clearDeleteModal(){
        $this->reset();

    }

    public function confirmDeleteDays(){
        for($i=0;$i<sizeof($this->daysList);$i++){
            $ShiftUserDay = ShiftUserDay::find($this->daysList[$i]["id"]);
            // dd($ShiftUserDay);
            $ShiftUserDay->shiftUserDayLog()->where('shift_user_day_id',  $ShiftUserDay->id)->delete();
            $ShiftUserDay->delete();
            $ShiftUserDaytoDelete = $ShiftUserDay->shift_user_id;
        }
        $CountShiftUserDay = ShiftUserDay::where('shift_user_id',$ShiftUserDaytoDelete)->get();
        if($CountShiftUserDay->count() == 0)
        {
            ShiftUser::find($ShiftUserDaytoDelete)->delete();
        }
        session()->flash('warning', 'Se han eliminado los dias seleccionados ');
        return redirect()->route('rrhh.shiftManag.index');
    }
}
