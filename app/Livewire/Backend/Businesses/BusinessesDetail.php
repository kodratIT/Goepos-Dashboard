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
    public $ownerUid;
    public $documents = [];
    public $paymentMethod = [];
    public $staff = [];

    public $bankType;
    public $nameAccount;
    public $bankNumber;
    public $isSaving = false;

    public $is_bankActive = false;


    // protected $rules = [
    //     'bankType' => 'required',
    //     'nameAccount' => 'required',
    //     'bankNumber' => 'required',
    // ];

    public function mount($id)
    {
        $this->ownerUid = $id;
    //     $this->getBussinesDetailByOwnerUid($id);
    //     $this->getPaymentMethod();
    //     $this->getStaffByOwnerUid($id);
    //     $this->getBankAccount($id);
    }

    protected function firestore()
    {
        return new BusinessesModel();
    }

    // public function getBussinesDetailByOwnerUid($ownerUid)
    // {
    //     $this->documents = $this->firestore()->getBussinesDetailByOwnerUid($ownerUid);
    // }

    // public function getPaymentMethod()
    // {
    //     $this->paymentMethod = $this->firestore()->getPaymentMethod();
    // }

    // public function getStaffByOwnerUid($ownerUid)
    // {
    //     $this->staff = $this->firestore()->getStaffByOwnerUid($ownerUid);
    // }

    // public function qrisActivate()
    // {
    //     $filteredBusinessId = null;

    //     foreach ($this->paymentMethod as $business) {
    //         if ($business->name === 'QRIS') {
    //             $filteredBusinessId = $business->id;
    //             break;
    //         }
    //     };

    //     $timestamp = Carbon::now();
    //     $result = $this->firestore()->activateQris($this->ownerUid, $timestamp,$filteredBusinessId);
    //     $this->getBussinesDetailByOwnerUid($this->ownerUid);

    // }



    public function render()
    {
        return view('livewire.backend.businesses.businesses-detail', [
            'data' => $this->ownerUid,
        ])->layout('layouts.app');
    }
}
