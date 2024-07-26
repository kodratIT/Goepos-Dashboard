<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\BusinessesModel;
use App\Models\bankShortCodeModel;

class BankAccountForm extends Component
{
    public $bankType;
    public $nameAccount;
    public $bankNumber;
    public $isSaving = false;
    public $ownerUid;
    public $bank_code = [];

    protected $rules = [
        'bankType' => 'required',
        'nameAccount' => 'required',
        'bankNumber' => 'required',
    ];

    public function mount($ownerUid){
        $this->ownerUid = $ownerUid;
        $this->getShortCodeBank();
    }

    protected function getShortCodeBank(){
        $this->bank_code = bankShortCodeModel::all();
    }

    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function saveBankAccount(){
        $this->validate();

        $data = [
            'bankShortCode' => $this->bankType,
            'nameAccount' => $this->nameAccount,
            'bankNumber' => $this->bankNumber,
        ];

        $requestApi = $this->firestore()->checkValidatedBankAccount($data);

        if($requestApi){
            $result = $this->firestore()->createBankAccount($this->ownerUid,$data);

            sleep(5);

            $this->isSaving = false;

            toastr()->success('Data Bank Berhasil di Buat!');

            $this->dispatch('bankSaved', true);

            $this->bankType = [];
            $this->nameAccount = [];
            $this->bankNumber = [];
        } else {
            toastr()->error('Data Bank Tidak Terdaftar!');
        }
    }

    public function render()
    {
        return view('livewire.backend.components.bank-account-form');
    }
}
