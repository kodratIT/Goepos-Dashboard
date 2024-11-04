<?php

namespace App\Livewire\Backend\ListTransactions;

use Livewire\Component;

class Qris extends Component
{

    public $ownerUid ="abc";

    public function render()
    {
        return view('livewire.backend.list-transactions.qris')->layout('layouts.app');;
    }
}
