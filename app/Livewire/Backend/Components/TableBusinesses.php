<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\BusinessesModel;

class TableBusinesses extends Component
{
    public $documents = [];
    public $newDocument = ['name' => ''];
    public $row = 25;
    protected $listeners = ['searchUpdated','updatedData'];

    public function mount()
    {
    }

    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function loadDocuments()
    {
        $this->documents  = $this->firestore()->getBusinessesAllbyCf($this->row);
        // dd($this->documents);

    }

    public function searchUpdated($documents)
    {

        $this->documents = [];
        $this->documents = json_decode(json_encode($documents), false);

    }
    public function updatedData($documents)
    {
        $this->documents = [];
        $this->documents = json_decode(json_encode($documents), false);
    }

    public function render()
    {
        return view('livewire.backend.components.table-businesses');
    }
}
