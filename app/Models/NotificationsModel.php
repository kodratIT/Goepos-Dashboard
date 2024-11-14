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

    public function createNotifications($data,$spesificTarget,$ownerUids){
        return $this->firestore->createNotifications($data,$spesificTarget,$ownerUids);
    }

    public function findNotificationById($id)
    {
        return $this->firestore->findNotificationById($id);
    }

    public function updateNotification($data,$spesificTarget,$ownerUids)
    {
        return $this->firestore->updateNotification($data,$spesificTarget,$ownerUids);
    }

    public function deleteNotification($id){
       return $this->firestore->deleteNotification($id);
    }

}
