<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;

class UserDetails extends Component
{
    public $data;

    public function mount($data)
    {
        $this->data = $data;
    }


    public function render()
    {
        return view('livewire.backend.components.user-details');
    }
}
