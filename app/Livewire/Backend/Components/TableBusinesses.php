<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\BusinessesModel;

class TableBusinesses extends Component
{
    public $documents = [];
    public $newDocument = ['name' => ''];
    public $row = 25;
    protected $listeners = ['searchUpdated'];

    public function mount()
    {
        // $this->loadDocuments();
    }

    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function loadDocuments()
    {
        $this->documents = $this->firestore()->getBusinessesAll(25);
        // dd($this->documents);
    }

    public function addDocument()
    {
        $this->validate([
            'newDocument.name' => 'required|string|max:255',
        ]);

        $this->firestore()->addDocument($this->newDocument['name']);

        $this->newDocument = ['name' => ''];
        $this->loadDocuments();

        return redirect()->back();
    }

    public function searchUpdated($documents)
    {
        $this->documents = [];
        $this->documents = json_decode(json_encode($documents), false);
        // dd($this->documents);
    }

    public function render()
    {
        return view('livewire.backend.components.table-businesses');
    }
}
