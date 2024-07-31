<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\BusinessesModel;

class SearchBusinesses extends Component
{
    public $searchTerm = '';
    public $documents = [];
    public $row = 25;

    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function loadDocuments()
    {
        $this->documents  = $this->firestore()->getBusinessesAllbyCf($this->row);

    }

    public function updateRow($row)
    {
        $this->row = $row;
        $this->loadDocuments();
        $this->dispatch('updatedData',  $this->documents);
    }

    public function searchBusinesses()
    {
        if ($this->searchTerm) {
            $this->documents = $this->firestore()->searchBusinesses($this->searchTerm);
        } else {
            $this->documents = [];
        }
        $this->dispatch('searchUpdated',  $this->documents);
    }

    public function render()
    {
        return view('livewire.backend.components.search-businesses');
    }
}
