<?php

namespace App\Livewire\Backend\Businesses;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Livewire\Component;
use App\Services\RequestApi;
use App\Models\BusinessesModel;
use App\Services\ServiceFirestore;
use App\Services\ServiceBusinesses;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class BusinessesDetail extends Component
{
    public $ownerUid = '';
    public $documents = [];
    public $paymentMethod = [];
    public $staff = [];

    public $bankType;
    public $nameAccount;
    public $bankNumber;
    public $isSaving = false;

    public $is_bankActive = false;


    protected $rules = [
        'bankType' => 'required',
        'nameAccount' => 'required|string|max:255',
        'bankNumber' => 'required|numeric|digits:15',
    ];

    public function mount($id)
    {
        $this->ownerUid = $id;
        $this->getBussinesDetailByOwnerUid($id);
        $this->getPaymentMethod();
        $this->getStaffByOwnerUid($id);
        $this->getBankAccount($id);
    }


    protected function firestore()
    {
        return new BusinessesModel();
    }

    public function getBussinesDetailByOwnerUid($ownerUid)
    {
        $this->documents = $this->firestore()->getBussinesDetailByOwnerUid($ownerUid);
    }

    public function getPaymentMethod()
    {
        $this->paymentMethod = $this->firestore()->getPaymentMethod();
    }

    public function getStaffByOwnerUid($ownerUid)
    {
        $this->staff = $this->firestore()->getStaffByOwnerUid($ownerUid);
    }

    public function qrisActivate()
    {
        $timestamp = Carbon::now();
        $result = $this->firestore()->activateQris($this->ownerUid, $timestamp);
        $this->getBussinesDetailByOwnerUid($this->ownerUid);

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

            return $this->redirect("/businesses/{$this->ownerUid}", navigate: true);

        }else{
            dd("data is not valid");
        }

    }

    public function getBankAccount($ownerUid){
        $result = $this->firestore()->getBankAccount($ownerUid);
        if($result){
            $this->is_bankActive = false;
        }else{
            $this->is_bankActive = true;
        }
    }

    public function render()
    {
        return view('livewire.backend.businesses.businesses-detail', [
            'data' => $this->documents,
        ])->layout('layouts.app');
    }
}
