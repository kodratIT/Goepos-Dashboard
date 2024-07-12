<?php

namespace App\Livewire\Backend\Businesses;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\BusinessesModel;
use App\Services\ServiceFirestore;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Contract\Firestore;

class Businesses extends Component
{
    public $documents = [];
    public $newDocument = ['name' => ''];
    public $searchTerm = '';

    protected $businessModel;

    public function mount()
    {
        $this->loadDocuments();
    }

    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function loadDocuments()
    {
        $this->documents = $this->firestore()->getBusinessesAll(5);
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

    public function searchBusinesses()
    {
        if ($this->searchTerm) {
            $this->documents = $this->firestore()->searchBusinesses($this->searchTerm);
        } else {
            $this->loadDocuments();
        }
    }

    public function render()
    {
        return view('livewire.backend.businesses.businesses', ['documents' => $this->documents])->layout('layouts.app');
    }

}
