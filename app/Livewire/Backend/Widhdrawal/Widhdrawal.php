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
    public $feeTransfer = 10000;
    public $balanceCheckout;
    public $verify = false;
    public $ownerUid;

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
        // }else{
        //     if(Session::get('verify') != null)
        //     return redirect()->route('transaction.qris', ['id' => $this->ownerUid]);
        // }
    }

    public function clearSession(){
        Session::forget('verify');
        Session::forget('balanceCheckout');
    }


    public function verifyWd(){
        Session::put('verify',true);
        Session::put('balanceCheckout',$this->balanceCheckout);

        return $this->redirect(route('widhdrawal.qris.verify', ['id' => $this->ownerUid]), navigate: true);
    }

    public function withdrawallSaldo(){
        dd("oke");
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

        $this->balanceAmount = $data->gross_qris_amount;
        $this->balanceCheckout = $data->gross_qris_amount;
        $this->feeTrx = $data->gross_qris_amount - $data->net_qris_amount;
    }

    public function createPaymentTransferQris(){

        dd([
            'document' => $this->document,
            'bankAccount' => $this->bankAccount,
            'balanceCheckout' => $this->balanceCheckout,
            'feeTransfer' => $this->feeTransfer,
            'ownerUid' => $this->ownerUid,
            'feeTrx' => $this->feeTrx,
        ]);
        $data = [
            'ownerUID' => $data->ownerUID,
            'ownerEmail' => $data->ownerEmail,
            'bankName' => $data->bankName,
            'bankNumber' => $data->bankNumber,
            'bankHolderName' => $data->bankHolderName,
            'amount' => $data->amount,
            'feeTrx' => $data->feeTrx,
            'feeTransfer' => $data->feeTransfer,
            'paymentMethod' => $data->paymentMethod
        ];
        $this->transaction()->createTransferPayment($data);
    }
    public function render()
    {
        return view('livewire.backend.widhdrawal.widhdrawal')->layout('layouts.app');
    }
}
