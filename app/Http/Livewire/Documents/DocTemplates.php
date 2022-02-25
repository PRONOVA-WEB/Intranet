<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use App\Models\Parameters\DocTemplate;
use App\Documents\Document;

class DocTemplates extends Component
{
    public $content;
    public $document;
    public $docTemplates;
    protected $listeners = ['typeChange' => 'changeEvent'];

    public function mount()
    {
        $this->docTemplates = DocTemplate::active()->get();
        $this->content = ($this->document) ? $this->document->content : '';
    }

    public function render()
    {
        return view('livewire.documents.doc-templates');
    }

    public function changeEvent(DocTemplate $docTemplate)
    {
        $this->content = $docTemplate->body;
        $this->dispatchBrowserEvent('tinyCharge');
    }

    public function resetContent(Document $document)
    {
        $this->content = $document->content;
        $this->dispatchBrowserEvent('tinyCharge');
    }

}
