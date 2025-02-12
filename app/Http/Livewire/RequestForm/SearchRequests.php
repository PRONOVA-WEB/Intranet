<?php

namespace App\Http\Livewire\RequestForm;

use App\Exports\RequestForms\RequestFormsExport;
use App\Models\Parameters\Parameter;
use Livewire\Component;
use App\Models\RequestForms\RequestForm;
use App\User;
use Carbon\Carbon;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Rrhh\OrganizationalUnit;

class SearchRequests extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectedStatus = null;
    public $selectedStatusPurchase = null;
    public $selectedId = null;
    public $selectedFolio = null;
    public $selectedName = null;
    public $selectedStartDate = null;
    public $selectedEndDate = null;
    public $selectedRequester = null;
    public $selectedRequesterOuName = null;
    public $selectedAdmin = null;
    public $selectedAdminOuName = null;
    public $selectedPurchaser = null;
    public $selectedProgram = null;
    public $selectedPo = null;
    public $selectedTender = null;
    public $result = null;
    public $inbox;

    public $organizationalUnit;

    protected $listeners = ['searchedRequesterOu', 'clearRequesterOu','searchedAdminOu', 'clearAdminOu'];

    protected $queryString = ['selectedStatus', 'selectedStatusPurchase', 'selectedId', 'selectedFolio',
        'selectedName', 'selectedStartDate', 'selectedEndDate', 'selectedRequester', 'selectedRequesterOuName',
        'selectedAdmin', 'selectedAdminOuName', 'selectedPurchaser', 'selectedProgram', 'selectedPo'
    ];

    public function mount() {
        if ($this->inbox == 'purchase' && $this->selectedStatusPurchase == null) {
            $this->selectedStatusPurchase = 'in_process';
        }
    }

    public function querySearch($isPaginated = true)
    {
        if($this->inbox == 'all'){
            $query = RequestForm::query();
        }
        if($this->inbox == 'purchase'){
            $query = RequestForm::query();
            
            $query->where('status', 'approved')->whereNotNull('signatures_file_id')
                ->whereHas('purchasers', function ($q) {
                    return $q->where('users.id', Auth()->user()->id);
                })
                ->latest('approved_at');
        }
        //$query = RequestForm::query();
        $query->search($this->selectedStatus,
        $this->selectedStatusPurchase,
        $this->selectedId,
        $this->selectedFolio,
        $this->selectedName,
        $this->selectedStartDate,
        $this->selectedEndDate,
        $this->selectedRequester,
        $this->selectedRequesterOuName,
        $this->selectedAdmin,
        $this->selectedAdminOuName,
        $this->selectedPurchaser,
        $this->selectedProgram,
        $this->selectedPo,
        $this->selectedTender
        )
        ->with('user', 'userOrganizationalUnit', 'purchaseMechanism', 'purchaseType', 'eventRequestForms.signerOrganizationalUnit', 'father:id,folio,has_increased_expense', 'purchasers', 'purchasingProcess')
        ->latest();

        return ($isPaginated) ? $query->paginate(50) : $query->get();
    }

    public function render()
    {   
        $ouSearch = Parameter::where('module', 'ou')->where('parameter', 'AbastecimientoSSI')->first()->value;
        return view('livewire.request-form.search-requests', [
            'request_forms' => $this->querySearch(),
            'users' => User::where('organizational_unit_id', $ouSearch)->orderBy('name','asc')->get(),
        ]);
    }

    public function export()
    {
        return Excel::download(new RequestFormsExport($this->querySearch(false)), 'requestFormsExport_'.Carbon::now().'.xlsx');
    }

    public function searchedRequesterOu(OrganizationalUnit $organizationalUnit){
        $this->selectedRequesterOuName = $organizationalUnit->id;
    }

    public function clearRequesterOu(){
        $this->selectedRequesterOuName = null;
    }

    public function searchedAdminOu(OrganizationalUnit $organizationalUnit){
        $this->selectedAdminOuName = $organizationalUnit->id;
    }

    public function clearAdminOu(){
        $this->selectedAdminOuName = null;
    }

    //RESET PAGE
    public function updatingSelectedStatus(){
        $this->resetPage();
    }

    public function updatingSelectedStatusPurchase(){
        $this->resetPage();
    }

    public function updatingSelectedId(){
        $this->resetPage();
    }

    public function updatingSelectedFolio(){
        $this->resetPage();
    }

    public function updatingName(){
        $this->resetPage();
    }

    public function updatingStartDate(){
        $this->resetPage();
    }

    public function updatingEndDate(){
        $this->resetPage();
    }

    public function updatingRequester(){
        $this->resetPage();
    }

    public function updatingRequesterOuName(){
        $this->resetPage();
    }

    public function updatingAdmin(){
        $this->resetPage();
    }

    public function updatingAdminOuName(){
        $this->resetPage();
    }

    public function updatingPurchaser(){
        $this->resetPage();
    }

    public function updatingProgram(){
        $this->resetPage();
    }

    public function updatingPo(){
        $this->resetPage();
    }
}
