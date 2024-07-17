<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\StaffModel;
use Kreait\Firebase\Factory;
use App\Models\BusinessesModel;
use Google\Cloud\Core\Timestamp;
use Kreait\Firebase\Contract\Firestore;

class ServiceFirestore
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = app('firebase.firestore')->database();
    }

    // Businesses

    public function getBusinessesAll($limit)
    {
        try {
            $documents = $this->firestore->collection("businesses")->limit($limit)->documents();
            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    // Tambahkan data dokumen ke array
                    $data[] = $document->data();
                }
            }
            return json_decode(json_encode($data), false);
        } catch (Exception $e) {
            // Log::error('Error fetching businesses: ' . $e->getMessage());
            return [];
        }
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

        $this->firestore->collection("businesses")->document($documentId)->set($data);
    }

    public function searchBusinesses($field, $searchTerm)
    {
        try {
            $query = $this->firestore->collection("businesses")
                ->where($field, '>=', $searchTerm)
                ->where($field, '<=', $searchTerm . '\uf8ff');
            $documents = $query->documents();

            $data = [];

            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = $document->data();
                }
            }

            return json_decode(json_encode($data), false);
        } catch (Exception $e) {
            // Log::error('Error
        }
    }

    public function getBussinesDetailByOwnerUid($ownerUid)
    {
        try {
            $collection = $this->firestore->collection('businesses')->where('ownerUid', '=', $ownerUid);
            $documents = $collection->documents();

            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = $document->data();
                }
            }

            // Pastikan data tidak kosong sebelum mengakses elemen pertama
            return !empty($data) ? json_decode(json_encode($data[0]), false) : null;
        } catch (Exception $e) {
            // Tangani kesalahan jika ada
            // Log::error('Error fetching documents by owner UID: ' . $e->getMessage());
            return null;
        }
    }

    public function getPaymentMethod()
    {
        try {
            $collection = $this->firestore->collection('paymentMethod');
            $paymentMethods = $collection->documents();

            $data = [];
            foreach ($paymentMethods as $document) {
                if ($document->exists()) {
                    $data[] = $document->data();
                }
            }
            return json_decode(json_encode($data), false);
        } catch (Exception $e) {
            // Tangani kesalahan jika ada
            // Log::error('Error fetching payment methods: ' . $e->getMessage());
            return json_decode(json_encode([]), false);
        }
    }

    public function getStaffByOwnerUid($ownerUid)
    {
        try {
            $collection = $this->firestore->collection("Businesses")->document($ownerUid)->collection('staffs');
            $documents = $collection->documents();

            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = $document->data();
                }
            }
            return json_decode(json_encode($data), false);
        } catch (Exception $e) {
            // Tangani kesalahan jika ada
            // Log::error('Error fetching staff by owner UID: ' . $e->getMessage());
            return json_decode(json_encode([]), false);
        }
    }


    public function activateQris($ownerUid, $timestamp,$paymentMethod)
    {
        $qris = [
            'activationStatus' => 'active',
            'activationStatusNote' => 'Syarat Terpenuhi',
            'activeAt' => new Timestamp($timestamp),
            'category' => [
                'name' => 'QRIS',
                'type' => 'qris',
            ],
            'createdAt' => new Timestamp($timestamp),
            'deletedAt' => null,
            'enabledByGoePos' => true,
            'enabledByOwner' => true,
            'id'   => $paymentMethod,
            'name' => 'QRIS'
        ];

        $referencePayment = [
            'net_qris_amount' => 0,
            'groos_qris_amount' => 0,
            'fee_qris_amount' => 0,
            'settlement_qris_amount' => 0,
            'ownerUid' => $ownerUid,
            'createdAt' => new Timestamp($timestamp),
        ];

        try {
            $this->firestore->collection('businesses')->document($ownerUid)->update([
                ['path' => 'qris', 'value' => $qris]
            ]);

            $this->firestore->collection('referencePayment')
                    ->document($ownerUid)
                    ->set($referencePayment);

            return 'Document updated successfully.';
        } catch (\Exception $e) {
            return 'Error updating document: ' . $e->getMessage();
        }
    }

    public function createBankAccount($ownerUid,$data){

        $bankAccount = [
            'ownerUid' => $ownerUid,
            'bankType' => $data['bankShortCode'],
            'accountNumber' => aes256Encrypt($data['bankNumber'],config('services.secretKeyBank.secretKey')),
            'nameAccount' => $data['nameAccount'],
        ];

        try {

            $this->firestore->collection('bankAccounts')
                    ->document($ownerUid)
                    ->set($bankAccount);

            return 'Document updated successfully.';
        } catch (\Exception $e) {
            return 'Error updating document: ' . $e->getMessage();
        }
    }

    public function getBankAccount($ownerUid)
    {
        try {
            $document = $this->firestore->collection('bankAccounts')->document($ownerUid)->snapshot();

            if ($document->exists()) {
                $data = [
                    'bankType' => $document->data()['bankType'],
                    'accountNumber' => aes256Decrypt($document->data()['accountNumber'], config('services.secretKeyBank.secretKey')),
                    'nameAccount' => $document->data()['nameAccount'],
                ];

                // Convert array to object
                return json_decode(json_encode($data));
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return 'Error getting document: ' . $e->getMessage();
        }

    }

    // End Businesses

    // Transaction
    public function getTransactionQris($ownerUid)
    {
        try {
            $collectionReference = $this->firestore->collection("referencePayment")
                                                   ->document($ownerUid)
                                                   ->collection("transactions")
                                                   ->document("payment")
                                                   ->collection("qris")
                                                   ->orderBy('createdAt', 'DESC'); // Mengurutkan berdasarkan field 'timestamp' secara descending

            $documents = $collectionReference->documents();

            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = $document->data();
                }
            }

            // Kembalikan data dalam format objek JSON
            return json_decode(json_encode($data), false);
        } catch (Exception $e) {
            // Log the error or handle it as needed
            Log::error('Error fetching documents: ' . $e->getMessage());
            return json_decode(json_encode([]), false);
        }

    }

    public function getTransactionDetail($ownerUid)
    {
        $documentReference = $this->firestore->collection("referencePayment")
                                       ->document($ownerUid);

        $document = $documentReference->snapshot();

        $data =[];
        if ($document->exists()) {
            $data = $document->data();
        }

        return  json_decode(json_encode($data), false);
    }



    public function addBankAccount($ownerUid, $data)
    {
        try {
            $collection = $this->firestore->collection('bankAccounts');
            $document = $collection->add([
                'ownerUid' => $ownerUid,
                'bankType' => $data['bankType'],
                'accountNumber' => $data['accountNumber'],
                'nameAccount' => $data['nameAccount'],
            ]);

            return true;
        } catch (GoogleException $e) {
            Log::error('Failed to add bank account: ' . $e->getMessage());
            return false;
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
