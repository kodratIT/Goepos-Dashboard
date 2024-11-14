<?php

namespace App\Models;

use App\Services\RequestApi;
use App\Services\ServiceFirestore;
use App\Services\ServiceCloudFunction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
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

    public function getAllNotifications($limit){
       return $this->firestore()->getAllNotifications($limit);
    }
    public function deleteNotification($id){

        dd("aa");
       return $this->firestore()->deleteNotification($id);
    }


}
