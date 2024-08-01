<?php

namespace App\Livewire\Backend\Widhdrawal;

use Livewire\Component;
use App\Models\BusinessesModel;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\Session;

class Widhdrawal extends Component
{
    public $bankAccount;
    public $document ;
    public $balanceAmount;
    public $feeTrx;
    public $feeTransfer = 5000;
    public $balanceCheckout;
    public $verify = false;
    public $ownerUid;
    public $groosAmount;

    public function mount($id)
    {
        $this->ownerUid = $id;
        $this->verify = Session::get('verify');
        $this->getBussinesDetailByOwnerUid($id);
        $this->getBankAccountByOwnerUid($id);
        $this->getTransactionDetail($id);

        if($this->verify){
            $this->balanceCheckout = Session::get('balanceCheckout');
            $this->balanceAmount =  $this->balanceCheckout;
            $this->clearSession();
        }
        $this->dispatch('documentsLoaded');
    }

    public function clearSession(){
        Session::forget('verify');
        Session::forget('balanceCheckout');
    }


    public function verifyWd(){
        Session::put('verify',true);
        Session::put('balanceCheckout',$this->balanceCheckout);
        $this->dispatch('documentsLoaded');
        return $this->redirect(route('widhdrawal.qris.verify', ['id' => $this->ownerUid]), navigate: true);
    }


    public function updateBalance($newValue)
    {
        $this->balanceCheckout = $newValue;
    }
    protected function firestore()
    {
        return new BusinessesModel();
    }

    protected function transaction()
    {
        return new TransactionModel();
    }


    protected function getBankAccountByOwnerUid($ownerUid){

        $this->bankAccount = $this->firestore()->getBankAccount($ownerUid);

    }
    public function getBussinesDetailByOwnerUid($ownerUid)
    {
        $this->document = $this->firestore()->getBussinesDetailByOwnerUid($ownerUid);
    }

    public function getTransactionDetail($ownerUid)
    {
        $data = $this->transaction()->getTransactionDetail($ownerUid);

        $this->balanceAmount = $data->net_qris_amount;
        $this->balanceCheckout = $data->net_qris_amount;
        $this->feeTrx = $data->fee_qris_amount;
        $this->groosAmount = $data->groos_qris_amount;
    }

    public function createPaymentTransferQris(){
        $data = [
            'ownerUID' => $this->ownerUid,
            'ownerEmail' => $this->document->email,
            'bankName' => $this->bankAccount->bankType,
            'bankNumber' => $this->bankAccount->accountNumber,
            'bankHolderName' => $this->bankAccount->nameAccount,
            'amount' => $this->balanceCheckout,
            'feeTrx' => $this->feeTrx,
            'feeTransfer' => $this->feeTransfer,
            'paymentMethod' => 'qris',
        ];

        $jsonData = json_encode($data);

        $result = $this->transaction()->createTransferPayment($jsonData);

        if($result){
            return $this->redirect(route('transaction.qris', ['id' => $this->ownerUid]), navigate: true);
            toastr()->success('Penarikan Saldo Berhasil di Buat');
        }else{
            toastr()->success('Penarikan Saldo Gagal di Buat');

        }
    }
    public function render()
    {
        return view('livewire.backend.widhdrawal.widhdrawal')->layout('layouts.app');
    }
}
