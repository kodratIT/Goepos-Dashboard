<?php

namespace App\Models;

use App\Services\ServiceFirestore;
use App\Services\ServiceBusinesses;
use App\Services\ServiceCloudFunction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionModel extends Model
{
    use HasFactory;

    protected $firestore;
    protected $function;

    public function __construct()
    {
        $this->firestore = new ServiceFirestore();
        $this->function = new ServiceCloudFunction();
    }

    public function getTransactionQris($ownerUid)
    {
        return $this->firestore->getTransactionQris($ownerUid);
    }
    public function getAllTransactionQris($limit)
    {
        return $this->firestore->getAllTransactionQris($limit);
    }

    public function getBussinesDetailByOwnerUid($ownerUid)
    {
        return $this->firestore->getBussinesDetailByOwnerUid($ownerUid);
    }

    public function getTransactionDetail($ownerUid)
    {
        return $this->firestore->getTransactionDetail($ownerUid);
    }
    public function createTransferPayment($data)
    {
        return $this->function->createTransferPayment($data);
    }


}
