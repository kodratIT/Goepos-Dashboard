<?php

namespace App\Livewire\Backend\Components;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\BusinessesModel;
use App\Models\TransactionModel;

class StaffDetails extends Component
{
    public $staff = [];
    public $paymentMethod = [];
    public $data;
    public $ownerUid;
    public $is_bankActive;
    public $net_amount = 0;

    protected $listeners = ['bankSaved','refreshComponent'];

    protected function firestore()
    {
        return new BusinessesModel();
    }

    protected function trx()
    {
        return new TransactionModel();
    }

    public function mount($ownerUid)
    {
        $this->ownerUid = $ownerUid;
        $this->getBankAccount($ownerUid);
        $this->refreshData();
        $this->dispatch('documentsLoaded');
    }

    public function bankSaved($status)
    {
        $this->is_bankActive = false;
        $this->refreshData();

    }

    public function refreshData()
    {
        $this->getStaffByOwnerUid($this->ownerUid);
        $this->getBussinesDetailByOwnerUid($this->ownerUid);
        $this->getPaymentMethod($this->ownerUid);
        $this->getNetAmountQris($this->ownerUid);
        $this->dispatch('documentsLoaded');
    }

    public function getPaymentMethod()
    {
        $this->paymentMethod = $this->firestore()->getPaymentMethod();
    }

    public function getStaffByOwnerUid($ownerUid)
    {
        $this->staff = $this->firestore()->getStaffByOwnerUid($ownerUid);
        $this->dispatch('documentsLoaded');
    }

    public function confirmActivate($paymentId)
    {
        $this->dispatch('confirm-activate', ['paymentId' => $paymentId]);
    }

    public function qrisActivate()
    {
        $filteredBusinessId = null;

        foreach ($this->paymentMethod as $business) {
            if ($business->name === 'QRIS') {
                $filteredBusinessId = $business->id;
                break;
            }
        }

        $timestamp = Carbon::now();
        $result = $this->firestore()->activateQris($this->ownerUid, $timestamp, $filteredBusinessId);

        if ($result) {
            $this->refreshData();
            $this->dispatch('qrisActivated'); // Emit event setelah QRIS diaktifkan
            toastr()->success('Berhasil Mengaktifkan Metode Qris');

        } else {
            toastr()->error('Gagal Mengaktifkan Metode Qris');
        }
    }

    public function getBussinesDetailByOwnerUid($ownerUid)
    {
        $this->data = $this->firestore()->getBussinesDetailByOwnerUid($ownerUid);
    }

    public function getBankAccount($ownerUid)
    {
        $result = $this->firestore()->getBankAccount($ownerUid);
        $this->is_bankActive = !$result;
    }

    public function getNetAmountQris($ownerUid)
    {
        $net_amount = $this->trx()->getTransactionDetail($ownerUid);
        $this->net_amount = $net_amount->net_qris_amount ?? '0';
    }

    public function qrisDisabled()
    {
        $status = $this->firestore()->disabledQrisByGoepos($this->ownerUid);
        if ($status) {
            $this->refreshData();
            $this->dispatch('refreshComponent');
            toastr()->success('QRIS Berhasil di Nonaktifkan!');

        } else {
            toastr()->error('QRIS Gagal di Nonaktifkan!');
        }
    }

    public function qrisActive()
    {
        $status = $this->firestore()->activedQrisByGoepos($this->ownerUid);
        if ($status) {
            $this->refreshData();
            $this->dispatch('refreshComponent');
            toastr()->success('QRIS Berhasil di Aktifkan!');
        } else {
            toastr()->error('QRIS Gagal di Aktifkan!');
        }
    }

    public function render()
    {
        return view('livewire.backend.components.staff-details');
    }
}
