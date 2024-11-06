<?php

namespace App\Models;

use App\Services\ServiceFirestore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationsModel extends Model
{
    use HasFactory;


    protected $firestore;
    protected $function;
    protected $requestApi;

    public function __construct()
    {
        $this->firestore = new ServiceFirestore();
    }

    public function getAllNotifications($limit){
       return $this->firestore->getAllNotifications($limit);
    }
}
