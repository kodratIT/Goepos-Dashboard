<?php

namespace App\Livewire\Backend\Components;

use Livewire\Component;
use App\Models\TransactionModel;

class TableTransactions extends Component
{
    public $transactions = [];


    public function mount($ownerUid)
    {
        $this->ownerUid = $ownerUid;
        $this->getTransactionQris();
    }

    protected function firestore()
    {
        return new TransactionModel();
    }

    public function getTransactionQris()
    {
        $this->transactions = $this->firestore()->getTransactionQris($this->ownerUid);
        // dd($this->transactions);

    }

    public function render()
    {
        return view('livewire.backend.components.table-transactions');
    }
}
