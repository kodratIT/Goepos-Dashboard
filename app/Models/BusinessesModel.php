<?php

namespace App\Models;

use Carbon\Carbon;
use App\Services\RequestApi;
use App\Services\ServiceStorage;
use Google\Cloud\Core\Timestamp;
use App\Services\ServiceFirestore;
use App\Services\ServiceCloudFunction;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessesModel extends Model
{
    use HasFactory;

    protected $firestore;
    protected $function;
    protected $requestApi;

    public function __construct()
    {
        $this->firestore = new ServiceFirestore();
        $this->function = new ServiceCloudFunction();
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
    public function getSubmissionByOwnerUid($ownerUid)
    {
        return  $this->firestore->getSubmissionByOwnerUid($ownerUid);
    }
    public function activateQris($ownerUid, $timestamp,$paymentMethod)
    {
        return  $this->firestore->activateQris($ownerUid, $timestamp,$paymentMethod);
    }
    public function disabledQrisByGoepos($ownerUid)
    {
        return  $this->firestore->disabledQrisByGoepos($ownerUid);
    }
    public function activedQrisByGoepos($ownerUid)
    {
        return  $this->firestore->activedQrisByGoepos($ownerUid);
    }

    public function createBankAccount($ownerUid, $data,$paymentId,$submisssion_id){
        return $this->firestore->createBankAccount($ownerUid, $data,$paymentId,$submisssion_id);
    }

    public function getBankAccount($ownerUid){
        return $this->firestore->getBankAccount($ownerUid);
    }
    public function rejectSubmission($ownerUid,$submisssion_id){
        return $this->firestore->rejectSubmission($ownerUid,$submisssion_id);
    }

    public function getBusinessesAllbyCf($limit)
    {
        return $this->function->getBussinessesAll($limit);
    }

    public function getImagesBusinessesCf($path){
        return $this->function->getImagesBusinesses($path);
    }


}
