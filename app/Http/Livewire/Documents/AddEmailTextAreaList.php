<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use Illuminate\Support\Arr;
use App\Rrhh\OrganizationalUnit;
use App\User;

use function PHPUnit\Framework\isNull;

class AddEmailTextAreaList extends Component
{
    public $organizationalUnit;
    public $user;
    public $users = [];
    public $selectedUser;
    public $userRequired;
    public $distribution;
    public $responsible;
    public $document;
    public $signature;
    public $recipients;

    public function mount()
    {
        if (!empty($this->organizationalUnit)) {
            $this->users = OrganizationalUnit::find($this->organizationalUnit)->users;
        }

        if ($this->document) {
            $this->distribution = $this->document->distribution;
            $this->responsible = $this->document->responsible;
        }
    }

    public function addToList(User $selectedUser, $list)
    {
        if ($selectedUser) {
            if (!str_contains($this->$list, $selectedUser->email)) {
                $this->$list = (empty($this->$list)) ? $selectedUser->email : $this->$list . PHP_EOL . $selectedUser->email;
            }
        }
    }

    public function render()
    {

        if (!empty($this->organizationalUnit)) {
            $this->users = OrganizationalUnit::find($this->organizationalUnit)->users;
        }
        else {
            $this->users = [];
        }

        return view('livewire.documents.add-email-text-area-list')
            ->withOuRoots(OrganizationalUnit::where('level', 1)->where('establishment_id', 1)->get());
    }
}
