<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;

use App\Models\Documents\CustomSignatureFlows\CustomSignatureFlow;

class CustomSignatureFlows extends Component
{
    public $customSignatureFlows;
    public $customSignatureFlow_id;

    public $CustomSignatureFlow;
    
    public function render()
    {
        $this->CustomSignatureFlow = CustomSignatureFlow::find($this->customSignatureFlow_id);
        return view('livewire.documents.custom-signature-flows');
    }
}
