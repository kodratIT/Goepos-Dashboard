<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\BusinessesModel;

class SearchBusinesses extends Component
{
    public $searchTerm = '';
    public $documents = [];

    protected function firestore()
    {
        return new BusinessesModel();
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
