<?php

namespace App\Livewire\Backend\Transaction;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\firestore;
use Illuminate\Support\Str;
use App\Models\TransactionModel;
use Google\Cloud\Core\Timestamp;
use Google\Cloud\Firestore\FieldValue;
use Illuminate\Support\Facades\Session;

class TransactionQris extends Component
{
    public $ownerUid;

    public function mount($id)
    {
        $this->ownerUid = $id;
    }

    public function render()
    {
        return view('livewire.backend.transaction.transaction-qris')->layout('layouts.app');
    }

}
