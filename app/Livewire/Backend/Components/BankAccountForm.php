<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;

class BankAccountForm extends Component
{
    public $bankType;
    public $nameAccount;
    public $bankNumber;
    public $isSaving = false;

    public function saveBankAccount()
    {
        // Simpan data bank
        $this->isSaving = true;

        // Simulate saving process
        sleep(2);

        $this->isSaving = false;
        $this->dispatchBrowserEvent('bankAccountSaved');
    }

    public function render()
    {
        return view('livewire.backend.components.bank-account-form');
    }
}
