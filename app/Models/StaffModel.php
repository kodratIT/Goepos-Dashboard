<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;

    public $createdAt;
    public $disabled;
    public $email;
    public $id;
    public $name;
    public $ownerEmail;
    public $ownerUid;
    public $password;
    public $phoneNumber;
    public $role;
    public $updatedAt;
    public $username;

    public function __construct(array $data = [])
    {
        $this->createdAt = $data['createdAt'] ?? null;
        $this->disabled = $data['disabled'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->ownerEmail = $data['ownerEmail'] ?? null;
        $this->ownerUid = $data['ownerUid'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->phoneNumber = $data['phoneNumber'] ?? null;
        $this->role = $data['role'] ?? null;
        $this->updatedAt = $data['updatedAt'] ?? null;
        $this->username = $data['username'] ?? null;
    }

    public static function fromFirestoreDocument(array $data)
    {
        return new self([
            'createdAt' => isset($data['createdAt']) && $data['createdAt'] instanceof \Google\Cloud\Core\Timestamp ? $data['createdAt']->get()->format('Y-m-d H:i:s') : ($data['createdAt'] ?? null),
            'disabled' => $data['disabled'] ?? null,
            'email' => $data['email'] ?? null,
            'id' => $data['id'] ?? null,
            'name' => $data['name'] ?? null,
            'ownerEmail' => $data['ownerEmail'] ?? null,
            'ownerUid' => $data['ownerUid'] ?? null,
            'password' => $data['password'] ?? null,
            'phoneNumber' => $data['phoneNumber'] ?? null,
            'role' => $data['role'] ?? null,
            'updatedAt' => isset($data['updatedAt']) && $data['updatedAt'] instanceof \Google\Cloud\Core\Timestamp ? $data['updatedAt']->get()->format('Y-m-d H:i:s') : ($data['updatedAt'] ?? null),
            'username' => $data['username'] ?? null,
        ]);
    }
}
