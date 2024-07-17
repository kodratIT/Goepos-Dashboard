<?php

namespace App\Models;

use Carbon\Carbon;
use App\Services\RequestApi;
use Google\Cloud\Core\Timestamp;
use App\Services\ServiceFirestore;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessesModel extends Model
{
    use HasFactory;

    protected $firestore;
    protected $requestApi;

    public function __construct()
    {
        $this->firestore = new ServiceFirestore();
        $this->requestApi = new RequestApi();

    }

    public function checkValidatedBankAccount($data){
        return $this->requestApi->checkValidatedBankAccount($data);
    }

    public function getBusinessesAll($limit)
    {
        return $this->firestore->getBusinessesAll($limit);
    }

    public function searchBusinesses ($searchTerm){
        return $this->firestore->searchBusinesses('email', $searchTerm);
    }

    public function getBussinesDetailByOwnerUid ($ownerUid){
        return $this->firestore->getBussinesDetailByOwnerUid($ownerUid);
    }

    public function getPaymentMethod(){
        return $this->firestore->getPaymentMethod();

    }
    public function getStaffByOwnerUid($ownerUid)
    {
        return  $this->firestore->getStaffByOwnerUid($ownerUid);
    }
    public function activateQris($ownerUid, $timestamp,$paymentMethod)
    {
        return  $this->firestore->activateQris($ownerUid, $timestamp,$paymentMethod);
    }

    public function createBankAccount($ownerUid, $data){
        return $this->firestore->createBankAccount($ownerUid, $data);
    }

    public function getBankAccount($ownerUid){
        return $this->firestore->getBankAccount($ownerUid);
    }


}
