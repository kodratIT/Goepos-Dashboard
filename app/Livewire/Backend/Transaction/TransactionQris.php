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

    public $transactions = [];
    public $transactionsDetail = [];
    public $ownerUid;
    public $document;


    public function mount($id)
    {
        $this->ownerUid = $id;
        $this->getTransactionDetail();
        $this->redirectUrl();
        $this->getTransactionQris();
        $this->getBussinesDetailByOwnerUid($id);
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

    public function getTransactionQris()
    {
        $this->transactions = $this->firestore()->getTransactionQris($this->ownerUid);
    }

    public function getTransactionDetail()
    {
        $this->transactionsDetail = $this->firestore()->getTransactionDetail($this->ownerUid);
    }

    public function getBussinesDetailByOwnerUid($ownerUid)
    {
        $this->documents = $this->firestore()->getBussinesDetailByOwnerUid($ownerUid);

    }

    public function render()
    {
        return view('livewire.backend.transaction.transaction-qris')->layout('layouts.app');
    }


    // Untuk Test Data
    // public function createTransaction(){
    //     $firestore = app('firebase.firestore')->database();
    //     $data = $this->generateRandomData();

    //     $firestore->collection("referencePayment")
    //             ->document($this->ownerUid)
    //             ->collection("transactions")
    //             ->document("payment")
    //             ->collection("qris")
    //             ->add($data);


    //     if($data['status'] == "paid"){
    //         $firestore->collection("referencePayment")
    //                 ->document($this->ownerUid)
    //                 ->update([
    //                     ['path' => 'gross_qris_amount', 'value' => FieldValue::increment($data['totalGrossAmount'])],
    //                     ['path' => 'net_qris_amount', 'value' => FieldValue::increment($data['totalNetAmount'])],
    //                 ]);
    //     }else if($data['status'] == "processing"){
    //         $firestore->collection("referencePayment")
    //         ->document($this->ownerUid)
    //         ->update([
    //             ['path' => 'settlement_qris_amount', 'value' => FieldValue::increment($data['totalNetAmount'])]
    //         ]);
    //     }else{

    //     }

    //     $this->getTransactionQris();
    //     $this->getTransactionDetail();
    // }
    // public function getRandomInt($min, $max)
    // {
    //     return mt_rand($min, $max);
    // }

    // public function getRandomString($length)
    // {
    //     return Str::random($length);
    // }

    // public function generateRandomData()
    // {
    //     $currentDate = Carbon::now();
    //     $statuses = ['paid', 'processing', 'expired'];
    //     $randomStatus = $statuses[array_rand($statuses)];
    //     return [
    //         'createdAt' => new Timestamp($currentDate),
    //         'id' => $this->getRandomString(16),
    //         'ownerEmail' => 'kodratcoc@gmail.com',
    //         'ownerUID' => $this->ownerUid,
    //         'referenceData' => [
    //             'amount' => $this->getRandomInt(1000, 20000),
    //             'bankName' => null,
    //             'createdAt' => $currentDate,
    //             'expiredAt' => new Timestamp($currentDate),
    //             'id' => 'QR_' . $this->getRandomString(28),
    //             'qrData' => $this->getRandomString(100)
    //         ],
    //         'recNumber' => null,
    //         'referenceId' => $this->getRandomString(16),
    //         'type' => 'qris',
    //         'status' => $randomStatus,
    //         'transactionGross' => [
    //             'createdAt' => new Timestamp($currentDate),
    //             'customer' => [],
    //             'discount' => [
    //                 'price' => 0,
    //                 'id' => $this->getRandomString(36),
    //                 'ownerUid' => $this->getRandomString(28)
    //             ],
    //             'products' => [
    //                 [
    //                     'additionalPrice' => 0,
    //                     'id' => $this->getRandomString(36),
    //                     'name' => 'Jahe',
    //                     'note' => '',
    //                     'orderPrintAtBar' => 1
    //                 ]
    //             ],
    //             'productId' => $this->getRandomString(36),
    //             'quantity' => $this->getRandomInt(1, 10),
    //             'subtotal' => $this->getRandomInt(1000, 10000),
    //             'totalPrice' => $this->getRandomInt(1000, 10000),
    //             'serviceCharge' => [
    //             ],
    //             'status' => 'First Payment',
    //             'subtotal' => 100000,
    //             'totalPrice' => 100000,
    //             'tax' => [
    //                 'id' =>'91c76c76-8c59-4be5-82a9-2660f3d6ca81',
    //                 'name' => 'Service',
    //                 'price' => '1000',
    //                 'value' => '10'
    //             ],
    //         ],
    //         'transactionNet' => [
    //             'createdAt' => new Timestamp($currentDate),
    //             'customer' => [],
    //             'discount' => [
    //                 'price' => 0,
    //                 'id' => $this->getRandomString(36),
    //                 'ownerUid' => $this->getRandomString(28)
    //             ],
    //             'products' => [
    //                 [
    //                     'additionalPrice' => 0,
    //                     'id' => $this->getRandomString(36),
    //                     'name' => 'Jahe',
    //                     'note' => '',
    //                     'orderPrintAtBar' => 1
    //                 ]
    //             ],
    //             'productId' => $this->getRandomString(36),
    //             'quantity' => $this->getRandomInt(1, 10),
    //             'subtotal' => $this->getRandomInt(1000, 10000),
    //             'totalPrice' => $this->getRandomInt(1000, 10000),
    //             'serviceCharge' => [
    //             ],
    //             'status' => 'First Payment',
    //             'subtotal' => 100000,
    //             'totalPrice' => 100000 - (10000*1.8/100),
    //             'feeTrx' => '1.8%',
    //             'tax' => [
    //                 'id' =>'91c76c76-8c59-4be5-82a9-2660f3d6ca81',
    //                 'name' => 'Service',
    //                 'price' => '1000',
    //                 'value' => '10'
    //             ],
    //         ],
    //         'totalGrossAmount' => 100000,
    //         'totalNetAmount' => 100000 - (100000*1.8/100),
    //         'feeTrx' => '1.8%',
    //         'userId' => $this->getRandomString(36),
    //         'userName' => 'Display',
    //         'description' => 'Saldo Masuk',
    //         'updateAt' => new Timestamp($currentDate)
    //     ];
    // }


}
