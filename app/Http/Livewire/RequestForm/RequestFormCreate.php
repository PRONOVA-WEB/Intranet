<?php

namespace App\Http\Livewire\RequestForm;
use Livewire\Component;
use App\Models\RequestForms\RequestForm;
use App\Models\RequestForms\RequestFormFile;
use App\Models\RequestForms\ItemRequestForm;
use App\Models\RequestForms\Passenger;
use App\Models\RequestForms\EventRequestForm;
use App\Models\Parameters\UnitOfMeasurement;
use App\Models\Parameters\PurchaseMechanism;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\TemporaryUploadedFile;
use App\Rrhh\Authority;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRequestFormNotification;
use App\Mail\RequestFormSignNotification;
use Illuminate\Contracts\Validation\Validator;

class RequestFormCreate extends Component
{
    use WithFileUploads;

    public $article, $unitOfMeasurement, $technicalSpecifications, $quantity, $typeOfCurrency, $articleFile, $subtype,
            $unitValue, $taxes, $fileItem, $totalValue, $lstUnitOfMeasurement, $title, $edit, $key, $request_form_id;

    public $name, $contractManagerId, $superiorChief, $purchaseMechanism, $messagePM,
            $program, $fileRequests = [], $justify, $totalDocument;

    public $items, $lstBudgetItem, $requestForm, $editRF, $deletedItems, $idRF, $savedFiles;
    public $budget_item_id, $lstPurchaseMechanism;

    public $passengers, $deletedPassengers;

    public $searchedUser, $isRFItems;

    public $form_status;

    protected $listeners = ['savedPassengers', 'savedItems', 'deletedItems', 'deletedPassengers'];

    protected function rules(){
      return [
        'name'                         =>  'required',
        'contractManagerId'            =>  'required',
        'subtype'                      =>  'required',
        'purchaseMechanism'            =>  'required',
        'program'                      =>  'required',
        'justify'                      =>  'required',
        'typeOfCurrency'               =>  'required',
        'fileRequests'                 =>  (!$this->editRF) ? 'required' : '',
        ($this->isRFItems ? 'items' : 'passengers') => 'required'
      ];
    }

    protected function messages(){
      return [
        'name.required'                =>  'Debe ingresar un nombre a este formulario.',
        'contractManagerId.required'   =>  'Debe ingresar un Administrador de Contrato.',
        'subtype.required'             =>  'Seleccione el tipo para este formulario.',
        'purchaseMechanism.required'   =>  'Seleccione un Mecanismo de Compra.',
        'program.required'             =>  'Ingrese un Programa Asociado.',
        'fileRequests.required'        =>  'Debe agregar los archivos solicitados',
        'justify.required'             =>  'Campo Justificación de Adquisición es requerido',
        'typeOfCurrency'               =>  'Ingrese un tipo de moneda',
        ($this->isRFItems ? 'items.required' : 'passengers.required') => ($this->isRFItems ? 'Debe agregar al menos un Item para Bien y/o Servicio' : 'Debe agregar al menos un Pasajero')
      ];
    }

    public function mount($requestForm){
      $this->isRFItems = request()->route()->getName() == 'request_forms.items.create' || ($requestForm && $requestForm->type_form == 'bienes y/o servicios');
      $this->purchaseMechanism      = "";
      $this->totalDocument          = 0;
      $this->items                  = array();
      $this->passengers             = array();
      $this->deletedItems           = array();
      $this->title                  = "Agregar Item";
      $this->edit                   = false;
      $this->editRF                 = false;
      $this->lstUnitOfMeasurement   = UnitOfMeasurement::all();
      $this->lstPurchaseMechanism   = PurchaseMechanism::all();
      if(!is_null($requestForm)){
        $this->requestForm = $requestForm;
        $this->setRequestForm();
      }
    }

    public function savedPassengers($passengers)
    {
      $this->passengers = $passengers;
    }

    public function savedItems($items)
    {
      $this->items = $items;
    }

    public function deletedItems($items)
    {
      $this->deletedItems = $items;
    }

    public function deletedPassengers($items)
    {
      $this->deletedPassengers = $items;
    }

    private function setRequestForm(){
      $this->request_form_id    =   $this->requestForm->request_form_id;
      $this->subtype            =   $this->requestForm->subtype;
      $this->name               =   $this->requestForm->name;
      $this->contractManagerId  =   $this->requestForm->contract_manager_id;
      $this->superiorChief      =   $this->requestForm->superior_chief;
      $this->program            =   $this->requestForm->program;
      $this->justify            =   $this->requestForm->justification;
      $this->purchaseMechanism  =   $this->requestForm->purchase_mechanism_id;
      $this->typeOfCurrency     =   $this->requestForm->type_of_currency;
      $this->estimated_expense  =   $this->requestForm->estimated_expense;
      $this->editRF             =   true;
      $this->idRF               =   $this->requestForm->id;
      $this->savedFiles         =   $this->requestForm->requestFormFiles;
      if($this->isRFItems)
        foreach($this->requestForm->itemRequestForms as $item)
          $this->setItems($item);
      else
        foreach($this->requestForm->passengers as $passenger)
          $this->setPassengers($passenger);
    }

    private function setItems($item){
      $this->items[]=[
            'id'                       => $item->id,
            'article'                  => $item->article,
            'unitOfMeasurement'        => $item->unit_of_measurement,
            'technicalSpecifications'  => $item->specification,
            'quantity'                 => $item->quantity,
            'unitValue'                => $item->unit_value,
            'taxes'                    => $item->tax,
            'totalValue'               => $item->expense,
            'articleFile'              => $item->article_file
      ];
    }

    private function setPassengers($passenger)
    {
      $this->passengers[]=[
            'id'                =>  $passenger->id,
            'passenger_type'    =>  $passenger->passenger_type,
            'run'               =>  $passenger->run,
            'dv'                =>  $passenger->dv,
            'name'              =>  $passenger->name,
            'fathers_family'    =>  $passenger->fathers_family,
            'mothers_family'    =>  $passenger->mothers_family,
            'birthday'          =>  $passenger->birthday,
            'phone_number'      =>  $passenger->phone_number,
            'email'             =>  $passenger->email,
            'round_trip'        =>  $passenger->round_trip,
            'origin'            =>  $passenger->origin,
            'destination'       =>  $passenger->destination,
            'departure_date'    =>  $passenger->departure_date,
            'return_date'       =>  $passenger->return_date,
            'baggage'           =>  $passenger->baggage,
            'unitValue'         =>  $passenger->unit_value
      ];
    }

   public function messageMechanism(){
      $this->messagePM = array();
      switch ($this->purchaseMechanism) {
          case 1: // MENORES A 3 UTM.
              $this->messagePM[] = "Especificaciones Técnicas";
              break;
          case 2: //Convenio Marco
              $this->messagePM[] = "Adjuntar ID Mercado Público";
              $this->messagePM[] = "Especificaciones Técnicas";
              $this->messagePM[] = "Decretos Presupuestarios, si procede.";
              $this->messagePM[] = "Convenios Mandatos, si procede.";
              $this->messagePM[] = "Resoluciones Aprobatorias de Programa Ministeriales, si procede.";
              break;
          case 3: // Trato Directo
              $this->messagePM[] = "Términos de Referencia y Especificaciones Técnicas.";
              $this->messagePM[] = "Decretos Presupuestarios, si procede.";
              $this->messagePM[] = "Convenios Mandatos, si procede.";
              $this->messagePM[] = "Resoluciones Aprobatorias de Programa Ministeriales, si procede.";
              $this->messagePM[] = "En el caso de realizar ADDENDUM O RENOVACIONES en los convenios
                                    vigentes, se debe adjuntar lo siguiente: Informe técnico que señale
                                    la justificación de la adquisición, una cotización por parte de la
                                    empresa que indique la compra asociada, y un correo de respaldo que
                                    la empresa acepta la nueva adquisición.";
              break;
          case 4: //LICITACIÓN PÚBLICA
              $this->messagePM[] = "Bases y  Especificaciones Técnicas.";
              $this->messagePM[] = "Decretos Presupuestarios, si procede.";
              $this->messagePM[] = "Convenios Mandatos, si procede.";
              $this->messagePM[] = "Resoluciones Aprobatorias de Programa Ministeriales, si procede.";
              $this->messagePM[] = "En el caso de realizar ADDENDUM O RENOVACIONES en los convenios
                                    vigentes, se debe adjuntar lo siguiente: Informe técnico que señale
                                    la justificación de la adquisición, una cotización por parte de la
                                    empresa que indique la compra asociada, y un correo de respaldo que
                                    la empresa acepta la nueva adquisición.";
              break;
          case 5: //COMPRA ÁGIL
              $this->messagePM[] = "Especificaciones Técnicas";
              $this->messagePM[] = "Decretos Presupuestarios, si procede.";
              $this->messagePM[] = "Convenios Mandatos, si procede.";
              $this->messagePM[] = "Resoluciones Aprobatorias de Programa Ministeriales, si procede.";
              break;
      }
    }

    public function totalForm(){
      $total = 0;
      foreach($this->isRFItems ? $this->items : $this->passengers as $item)
        $total += $item[$this->isRFItems ? 'totalValue' : 'unitValue'];

      return $total;
    }

    private function createFolio(){
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $counter = RequestForm::withTrashed()->whereNull('request_form_id')->where('created_at', '>=' , $startOfYear)->where('created_at', '<=', $endOfYear)->count();
        return Carbon::now()->year.'-'.$counter;
    }

    public function saveRequestForm($form_status){
      $this->form_status = $form_status;

      $this->withValidator(function (Validator $validator) {
        $validator->after(function ($validator) {
            if ($this->available_balance_purchases_exceeded()) {
               return $validator->errors()->add('balance', 'Saldo disponible para compras del formulario de requerimiento principal excedido con los items y montos registrados en este suministro. Saldo disponible: '.number_format($this->requestForm->father->purchasingProcess->getExpense() - $this->requestForm->father->getTotalExpense(),0,",","."));
            }
        });
      })->validate();

      $req = DB::transaction(function () {

        //dd("chequear por jefatura");
        if($this->form_status == 'sent'){
            $req = RequestForm::updateOrCreate(
              [
                'id'                    =>  $this->idRF,
              ],
              [
                'subtype'               =>  $this->subtype,
                'contract_manager_id'   =>  $this->editRF ? $this->requestForm->contract_manager_id : $this->contractManagerId,
                //contractManagerId
                //'contract_manager_id'   =>  Authority::getBossFromUser$this->contractManagerId,
                //'contract_manager_ou_id' => User::with('organizationalUnit')->find($this->contractManagerId)->organizationalUnit->id,
                'contract_manager_ou_id' => $this->editRF ? $this->requestForm->contract_manager_ou_id : Authority::getBossFromUser($this->contractManagerId,Carbon::now())->organizational_unit_id,
                'name'                  =>  $this->name,
                'superior_chief'        =>  $this->superiorChief,
                'justification'         =>  $this->justify,
                'type_form'             =>  $this->isRFItems ? 'bienes y/o servicios' : 'pasajes aéreos',
                'request_user_id'       =>  $this->editRF ? $this->requestForm->request_user_id : Auth()->user()->id,
                'request_user_ou_id'    =>  $this->editRF ? $this->requestForm->request_user_ou_id : Auth()->user()->organizationalUnit->id,
                'estimated_expense'     =>  $this->totalForm(),
                'type_of_currency'      =>  $this->typeOfCurrency,
                'purchase_mechanism_id' =>  $this->purchaseMechanism,
                'program'               =>  $this->program,
                'status'                =>  'pending'
            ]);
        }
        else{
            $req = RequestForm::updateOrCreate(
              [
                'id'                    =>  $this->idRF,
              ],
              [
                'subtype'               =>  $this->subtype,
                'contract_manager_id'   =>  $this->editRF ? $this->requestForm->contract_manager_id : $this->contractManagerId,
                //contractManagerId
                //'contract_manager_id'   =>  Authority::getBossFromUser$this->contractManagerId,
                //'contract_manager_ou_id' => User::with('organizationalUnit')->find($this->contractManagerId)->organizationalUnit->id,
                'contract_manager_ou_id' => $this->editRF ? $this->requestForm->contract_manager_ou_id : Authority::getBossFromUser($this->contractManagerId,Carbon::now())->organizational_unit_id,
                'name'                  =>  $this->name,
                'superior_chief'        =>  $this->superiorChief,
                'justification'         =>  $this->justify,
                'type_form'             =>  $this->isRFItems ? 'bienes y/o servicios' : 'pasajes aéreos',
                'request_user_id'       =>  $this->editRF ? $this->requestForm->request_user_id : Auth()->user()->id,
                'request_user_ou_id'    =>  $this->editRF ? $this->requestForm->request_user_ou_id : Auth()->user()->organizationalUnit->id,
                'estimated_expense'     =>  $this->totalForm(),
                'type_of_currency'      =>  $this->typeOfCurrency,
                'purchase_mechanism_id' =>  $this->purchaseMechanism,
                'program'               =>  $this->program,
                'status'                =>  $this->editRF ? $this->requestForm->status : 'saved'
            ]);
        }

        if($this->isRFItems){
          // save items
          foreach($this->items as $item){
            ItemRequestForm::updateOrCreate(
              [
                'id'                    =>      $item['id'],
              ],
              [
                'request_form_id'       =>      $req->id,
                'article'               =>      $item['article'],
                'unit_of_measurement'   =>      $item['unitOfMeasurement'],
                'specification'         =>      $item['technicalSpecifications'],
                'quantity'              =>      $item['quantity'],
                'unit_value'            =>      $item['unitValue'],
                'tax'                   =>      $item['taxes'],
                'expense'               =>      $item['totalValue'],
                'article_file'          =>      $item['articleFile']
            ]);
          }
        } else {
          foreach($this->passengers as $passenger){
            // save passengers
            Passenger::updateOrCreate(
              [
                'id'                =>  $passenger['id'],
              ],
              [
                'user_id'           =>  Auth()->user()->id,
                'run'               =>  $passenger['run'],
                'dv'                =>  $passenger['dv'],
                'name'              =>  $passenger['name'],
                'fathers_family'    =>  $passenger['fathers_family'],
                'mothers_family'    =>  $passenger['mothers_family'],
                'birthday'          =>  $passenger['birthday'],
                'phone_number'      =>  $passenger['phone_number'],
                'email'             =>  $passenger['email'],
                'round_trip'        =>  $passenger['round_trip'],
                'origin'            =>  $passenger['origin'],
                'destination'       =>  $passenger['destination'],
                'departure_date'    =>  $passenger['departure_date'],
                'return_date'       =>  $passenger['return_date'],
                'baggage'           =>  $passenger['baggage'],
                'unit_value'        =>  $passenger['unitValue'],
                'request_form_id'   =>  $req->id
              ]);
          }
        }

        if($this->editRF){
          if($this->form_status == 'sent'){
              EventRequestform::createLeadershipEvent($req);
              EventRequestform::createPreFinanceEvent($req);
              EventRequestform::createFinanceEvent($req);
              EventRequestform::createSupplyEvent($req);

              //Envío de notificación a Adm de Contrato y abastecimiento.
              $mail_contract_manager = User::select('email')
                ->where('id', $req->contract_manager_id)
                ->first();

              if($mail_contract_manager){
                  $emails = [$mail_contract_manager];
                  Mail::to($emails)
                    ->cc(env('APP_RF_MAIL'))
                    ->send(new NewRequestFormNotification($req));
              }
              //---------------------------------------------------------

              //Envío de notificación para visación.
              $now = Carbon::now();
              //manager
              $type = 'manager';
              $mail_notification_ou_manager = Authority::getAuthorityFromDate($req->eventRequestForms->first()->ou_signer_user, Carbon::now(), $type);
              //secretary
              // $type_adm = 'secretary';
              // $mail_notification_ou_secretary = Authority::getAuthorityFromDate($req->eventRequestForms->first()->ou_signer_user, Carbon::now(), $type_adm);

              $emails = [$mail_notification_ou_manager->user->email];

              if($mail_notification_ou_manager){
                  Mail::to($emails)
                    ->cc(env('APP_RF_MAIL'))
                    ->send(new RequestFormSignNotification($req, $req->eventRequestForms->first()));
              }
              //---------------------------------------------------------

              session()->flash('info', 'Formulario de requerimiento N° '.$req->folio.' fue creado con exito.');
          }

          $this->isRFItems ? ItemRequestForm::destroy($this->deletedItems) : Passenger::destroy($this->deletedPassengers);
          session()->flash('info', 'Formulario de requerimiento N° '.$req->folio.' fue editado con exito.');
        }
        else{ // nuevo formulario de requerimiento
          $req->update(['folio' => $this->createFolio()]);
          if($this->form_status == 'sent'){
              EventRequestform::createLeadershipEvent($req);
              EventRequestform::createPreFinanceEvent($req);
              EventRequestform::createFinanceEvent($req);
              EventRequestform::createSupplyEvent($req);

              //Envío de notificación a Adm de Contrato y abastecimiento.
              $mail_contract_manager = User::select('email')
                ->where('id', $req->contract_manager_id)
                ->first();

              if($mail_contract_manager){
                  $emails = [$mail_contract_manager];
                  Mail::to($emails)
                    ->cc(env('APP_RF_MAIL'))
                    ->send(new NewRequestFormNotification($req));
              }
              //---------------------------------------------------------

              //Envío de notificación para visación.
              $now = Carbon::now();
              //manager
              $type = 'manager';
              $mail_notification_ou_manager = Authority::getAuthorityFromDate($req->eventRequestForms->first()->ou_signer_user, Carbon::now(), $type);
              //secretary
              // $type_adm = 'secretary';
              // $mail_notification_ou_secretary = Authority::getAuthorityFromDate($req->eventRequestForms->first()->ou_signer_user, Carbon::now(), $type_adm);

              $emails = [$mail_notification_ou_manager->user->email];

              if($mail_notification_ou_manager){
                  Mail::to($emails)
                    ->cc(env('APP_RF_MAIL'))
                    ->send(new RequestFormSignNotification($req, $req->eventRequestForms->first()));
              }
              //---------------------------------------------------------

              session()->flash('info', 'Formulario de requerimiento N° '.$req->folio.' fue creado con exito.');
          }
        }

        // Se guarda los archivos del form req cuando ya todo lo anteior se guardó exitosamente
        foreach($this->fileRequests as $nFiles => $fileRequest){
          $reqFile = new RequestFormFile();
          // if(env('APP_ENV') == 'local' || env('APP_ENV') == 'testing'){
              $now = Carbon::now()->format('Y_m_d_H_i_s');
              $file_name = $now.'_req_file_'.$nFiles;
              $reqFile->name = $fileRequest->getClientOriginalName();
              $reqFile->file = $fileRequest->storeAs('/request_forms/request_files', $file_name.'.'.$fileRequest->extension(), 'gcs');
              $reqFile->request_form_id = $req->id;
              $reqFile->user_id = Auth()->user()->id;
              $reqFile->save();
          // }
        }

        return $req;

      });

      return redirect()->route('request_forms.show', $this->editRF ? $this->requestForm->id : $req->id);
    }

    public function btnCancelRequestForm(){
      return redirect()->to('/request_forms/my_forms');
    }

    public function destroyFile($id)
    {
      $requestFormFile = RequestFormFile::find($id);
      Storage::delete($requestFormFile->file);
      $requestFormFile->delete();

      $this->savedFiles = RequestFormFile::where('request_form_id', $this->requestForm->id)->get();
    }

    public function render(){
        $this->messageMechanism();
        // $users = User::where('organizational_unit_id', Auth::user()->organizational_unit_id)->orderBy('name', 'ASC')->get();
        $users = User::where('external', 0)
          ->orderBy('name', 'ASC')
          ->get(['id', 'name', 'fathers_family', 'mothers_family']); //get specific columns equals best perfomance bench
        return view('livewire.request-form.request-form-create', compact('users'));
    }

    public function available_balance_purchases_exceeded()
    {
      if($this->requestForm && $this->requestForm->request_form_id){ // es suministro de req. form principal
        //total del monto por items seleccionados en otros suministros + item registrados no debe sobrepasar el total adjudicado al formulario de requerimiento
        $totalItemSelected = 0;
        foreach($this->items as $item)
            $totalItemSelected += $item['totalValue'];

        $this->requestForm->load('father.purchasingProcess.details');
        return $this->requestForm->father->purchasingProcess->getExpense() - $this->requestForm->father->getTotalExpense() < $totalItemSelected;
      }
      return false;
    }

    public function updatedFileRequests($value)
    {
      $this->fileRequests = $value;
    }

    public function updatedTypeOfCurrency($value){
      $this->emit('savedTypeOfCurrency', $value);
    }
}
