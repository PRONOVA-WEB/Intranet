<?php

namespace App\Http\Livewire\ReplacementStaff;

use Livewire\Component;

class Profile extends Component
{
    public $inputs = [];
    public $i = 1;
    public $replacementStaff;
    public $professionManage;
    public $profileManage;
    public $estado = '';
    //public $usersSelect ='readonly';
    public $profileSelected =null;
    public $selectstate = 'disabled';

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function mount($replacementStaff, $professionManage, $profileManage)
    {
        $this->replacementStaff = $replacementStaff;
        $this->professionManage = $professionManage;
        $this->profileManage = $profileManage;
        
    }

    public function updatedprofileSelected($profile_id){

        
        if($profile_id ==2 or $profile_id ==4)
        {
            $this->selectstate = '';        

        }
        else{
            $this->selectstate = 'disabled';
            
        }   
        
        
        


    }

    public function render()
    {
        
        return view('livewire.replacement-staff.profile', compact($this->replacementStaff, $this->professionManage, $this->profileManage));
        
    }

}
