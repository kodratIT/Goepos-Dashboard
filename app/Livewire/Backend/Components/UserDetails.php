<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\BusinessesModel;

class UserDetails extends Component
{
    public $ownerUid;
    public $data;
    public $isLoading = true;
    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function mount($ownerUid)
    {
        $this->ownerUid = $ownerUid;
        $this->getBussinesDetailByOwnerUid($ownerUid);
        $this->isLoading = false;
    }


    public function getBussinesDetailByOwnerUid($ownerUid)
    {
        $this->data = $this->firestore()->getBussinesDetailByOwnerUid($ownerUid);
    }

    public function render()
    {
        return view('livewire.backend.components.user-details');
    }
}
