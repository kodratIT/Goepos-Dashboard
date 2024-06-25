<?php

namespace App\Livewire\Backend\Businesses;

use Carbon\Carbon;
use Livewire\Component;
use App\Services\ServiceBusinesses;

class BusinessesDetail extends Component
{
    public $ownerUid = '';
    public $documents = [];
    public $paymentMethod = [];
    public $staff = [];

    public function mount($id)
    {
        $this->ownerUid = $id;
        $this->getDatabyOwnerUid($id);
        $this->getPaymentMethod();
        $this->getStaffByOwnerUid($id);
    }

    protected function getServiceBusinesses()
    {
        return new ServiceBusinesses();
    }

    public function getDatabyOwnerUid($ownerUid)
    {
        $this->documents = $this->getServiceBusinesses()->getDocumentsByOwnerUid($ownerUid);
    }

    public function getPaymentMethod()
    {
        $this->paymentMethod = $this->getServiceBusinesses()->getPaymentMethods();
    }

    public function getStaffByOwnerUid($ownerUid)
    {
        $this->staff = $this->getServiceBusinesses()->getStaffByOwnerUid($ownerUid);
    }

    public function qrisActivate()
    {
        $timestamp = Carbon::now();
        $result = $this->getServiceBusinesses()->activateQris($this->ownerUid, $timestamp);
        session()->flash('message', $result);
        $this->getDatabyOwnerUid($this->ownerUid);

    }

    public function render()
    {
        return view('livewire.backend.businesses.businesses-detail', [
            'data' => $this->documents,
        ])->layout('layouts.app');
    }
}
