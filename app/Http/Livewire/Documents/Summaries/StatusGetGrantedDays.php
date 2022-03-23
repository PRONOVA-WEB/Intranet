<?php

namespace App\Http\Livewire\Documents\Summaries;

use Livewire\Component;

use App\Models\Documents\Summaries\SummaryStatus;

class StatusGetGrantedDays extends Component
{
    public $summaryStatus;
    public $status_id;
    public $granted_days;

    public function render()
    {
        if ($this->status_id != null) {
          $summaryEvent = SummaryStatus::find($this->status_id);
          $this->granted_days = $summaryEvent->granted_days;
        }else{
          $this->granted_days = null;
        }

        return view('livewire.documents.summaries.status-get-granted-days');
    }
}
