<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;

class StaffDetails extends Component
{
    public $staff = [];
    public $paymentMethod = [];
    public $data;
    public $is_bankActive;

    public function mount($staff, $paymentMethod, $data, $is_bankActive)
    {
        $this->staff = $staff;
        $this->paymentMethod = $paymentMethod;
        $this->data = $data;
        $this->is_bankActive = $is_bankActive;
    }

    public function render()
    {
        return view('livewire.backend.components.staff-details');
    }
}
