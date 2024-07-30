<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\TransactionModel;

class SidebarTransactions extends Component
{

    public $transactionsDetail;

    public function mount($ownerUid)
    {
        $this->ownerUid = $ownerUid;
        $this->getTransactionDetail();
        $this->redirectUrl();
    }

    protected function firestore()
    {
        return new TransactionModel();
    }

    public function redirectUrl()
    {
        if (empty($this->transactionsDetail)) {
            return redirect()->route('businesses.detail',['id' => $this->ownerUid]);
        }
    }

    public function getTransactionDetail()
    {
        $this->transactionsDetail = $this->firestore()->getTransactionDetail($this->ownerUid);
    }
    public function render()
    {
        return view('livewire.backend.components.sidebar-transactions');
    }
}
