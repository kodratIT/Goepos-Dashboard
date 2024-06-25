<?php

namespace App\Models;

use Carbon\Carbon;
use Google\Cloud\Core\Timestamp;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessesModel extends Model
{
    use HasFactory;

    public $createdAt;
    public $description;
    public $displayImage;
    public $email;
    public $id;
    public $image;
    public $location;
    public $name;
    public $ownerEmail;
    public $ownerUid;
    public $phone;
    public $promoReceiptModel;
    public $subscriptionProducts;
    public $subscriptionStaffs;
    public $updatedAt;
    public $vatNumber;
    public $website;
    public $qris;

    public function __construct(array $data = [])
    {
        $this->createdAt = $data['createdAt'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->displayImage = $data['displayImage'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->image = $data['image'] ?? null;
        $this->location = $data['location'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->ownerEmail = $data['ownerEmail'] ?? null;
        $this->ownerUid = $data['ownerUid'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->promoReceiptModel = $data['promoReceiptModel'] ?? null;
        $this->subscriptionProducts = $data['subscriptionProducts'] ?? null;
        $this->subscriptionStaffs = $data['subscriptionStaffs'] ?? null;
        $this->updatedAt = $data['updatedAt'] ?? null;
        $this->vatNumber = $data['vatNumber'] ?? null;
        $this->website = $data['website'] ?? null;
        $this->qris = $data['qris'] ?? null;
    }

    public static function fromFirestoreDocument(array $data)
    {
        return new self([
            'createdAt' => isset($data['createdAt']) && $data['createdAt'] instanceof \Google\Cloud\Core\Timestamp ? $data['createdAt']->get()->format('Y-m-d H:i:s') : ($data['createdAt'] ?? null),
            'description' => $data['description'] ?? null,
            'displayImage' => $data['displayImage'] ?? null,
            'email' => $data['email'] ?? null,
            'id' => $data['id'] ?? null,
            'image' => $data['image'] ?? null,
            'location' => $data['location'] ?? null,
            'name' => $data['name'] ?? null,
            'ownerEmail' => $data['ownerEmail'] ?? null,
            'ownerUid' => $data['ownerUid'] ?? null,
            'phone' => $data['phone'] ?? null,
            'promoReceiptModel' => $data['promoReceiptModel'] ?? null,
            'subscriptionProducts' => $data['subscriptionProducts'] ?? null,
            'subscriptionStaffs' => $data['subscriptionStaffs'] ?? null,
            'updatedAt' => isset($data['updatedAt']) && $data['updatedAt'] instanceof \Google\Cloud\Core\Timestamp ? $data['updatedAt']->get()->format('Y-m-d H:i:s') : ($data['updatedAt'] ?? null),
            'vatNumber' => $data['vatNumber'] ?? null,
            'website' => $data['website'] ?? null,
            'qris' => $data['qris'] ?? null,
        ]);
    }
}
