<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\StaffModel;
use Kreait\Firebase\Factory;
use App\Models\BusinessesModel;
use Google\Cloud\Core\Timestamp;
use Kreait\Firebase\Contract\Firestore;

class ServiceBusinesses
{
    protected $firestore;
    protected $collection = 'Businesses';

    public function __construct()
    {
        $this->firestore = app('firebase.firestore')->database();
    }

    public function getAllDocuments()
    {
        $documents = $this->firestore->collection($this->collection)->documents();
        $data = [];
        foreach ($documents as $document) {
            $docData = $document->data();
            $data[] = BusinessesModel::fromFirestoreDocument($this->formatTimestamps($docData));
        }
        return $data;
    }

    public function addDocument($name)
    {
        $timestamp = Carbon::now();
        $documentId = $this->generateOwnerUid();

        $data = [
            'name' => $name,
            'createdAt' => $timestamp,
            'updatedAt' => $timestamp,
            'email' => $name . '@gmail.com',
            'location' => [
                'city' => '',
                'country' => '',
                'street' => '',
                'zipcode' => '',
            ],
            'ownerUid' => $documentId,
            'phone' => '',
            'subscriptionId' => 'goepos_free',
            'vatNumber' => '',
            'website' => ''
        ];

        $this->firestore->collection($this->collection)->document($documentId)->set($data);
    }

    public function searchDocuments($field, $searchTerm)
    {
        $query = $this->firestore->collection($this->collection)
            ->where($field, '>=', $searchTerm)
            ->where($field, '<=', $searchTerm . '\uf8ff');
        $documents = $query->documents();

        $data = [];
        foreach ($documents as $document) {
            $docData = $document->data();
            $data[] = BusinessesModel::fromFirestoreDocument($this->formatTimestamps($docData));
        }
        return $data;
    }


    public function getDocumentsByOwnerUid($ownerUid)
    {
        $collection = $this->firestore->collection('Businesses')->where('ownerUid', '=', $ownerUid);
        $documents = $collection->documents();

        $data = [];
        foreach ($documents as $document) {
            $docData = $document->data();
            $data[] = BusinessesModel::fromFirestoreDocument($this->formatTimestamps($docData));
        }
        return $data[0];
    }

    public function getPaymentMethods()
    {
        $collection = $this->firestore->collection('paymentMethod');
        $paymentMethods = $collection->documents();

        $data = [];
        foreach ($paymentMethods as $document) {
            $data[] = $document->data();
        }
        return $data;
    }

    public function getStaffByOwnerUid($ownerUid)
    {
        $collection = $this->firestore->collection($this->collection)->document($ownerUid)->collection('staffs');
        $documents = $collection->documents();
        $data = [];
        foreach ($documents as $document) {
            $docData = $document->data();
            $data[] = StaffModel::fromFirestoreDocument($this->formatTimestamps($docData));
        }
        return $data;
    }

    public function activateQris($ownerUid, $timestamp)
    {
        $qris = [
            'activationStatus' => true,
            'activationStatusNote' => 'Syarat Terpenuhi',
            'activeAt' => new Timestamp($timestamp),
            'category' => [
                'name' => 'QRIS',
                'type' => 'qris',
            ],
            'createdAt' => new Timestamp($timestamp),
            'deletedAt' => null,
            'enableByGoePos' => true,
            'enableByOwner' => true,
        ];

        try {
            $this->firestore->collection('Businesses')->document($ownerUid)->update([
                ['path' => 'qris', 'value' => $qris]
            ]);

            return 'Document updated successfully.';
        } catch (\Exception $e) {
            return 'Error updating document: ' . $e->getMessage();
        }
    }

    protected function formatTimestamps($document)
    {
        if (isset($document['createdAt']) && $document['createdAt'] instanceof Timestamp) {
            $document['createdAt'] = $document['createdAt']->get()->format('Y-m-d');
        }
        if (isset($document['updatedAt']) && $document['updatedAt'] instanceof Timestamp) {
            $document['updatedAt'] = $document['updatedAt']->get()->format('Y-m-d');
        }
        return $document;
    }

    protected function generateOwnerUid()
    {
        return uniqid('owner_', true);
    }
}
