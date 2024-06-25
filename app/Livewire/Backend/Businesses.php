<?php

namespace App\Livewire\Backend;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\BusinessesModel;
use App\Services\ServiceBusinesses;
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

    protected function getServiceBusinesses()
    {
        return new ServiceBusinesses();
    }

    public function loadDocuments()
    {
        $this->documents = $this->getServiceBusinesses()->getAllDocuments();
    }

    public function addDocument()
    {
        $this->validate([
            'newDocument.name' => 'required|string|max:255',
        ]);

        $this->getServiceBusinesses()->addDocument($this->newDocument['name']);

        $this->newDocument = ['name' => ''];
        $this->loadDocuments();

        return redirect()->back();
    }

    public function searchDocuments()
    {
        if ($this->searchTerm) {
            $this->documents = $this->getServiceBusinesses()->searchDocuments('email', $this->searchTerm);
        } else {
            $this->loadDocuments();
        }
    }

    public function render()
    {
        return view('livewire.backend.businesses', ['documents' => $this->documents])->layout('layouts.app');
    }
}
