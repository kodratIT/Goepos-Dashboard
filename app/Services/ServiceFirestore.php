<?php

namespace App\Services;

use DateTime;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\StaffModel;
use Kreait\Firebase\Factory;
use App\Helpers\HelpersUtils;
use App\Models\BusinessesModel;
use GuzzleHttp\Promise;
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
    // public function getBusinessesAll($limit)
    // {
    //     try {
    //         // Calculate the previous month in the format 'YYYY-MM'
    //         $previousMonth = (new DateTime('first day of last month'))->format('Y-m');

    //         // Calculate the previous day in the format 'YYYY-MM-DD'
    //         $previousDay = (new DateTime('yesterday'))->format('Y-m-d');

    //         // Fetch business documents
    //         $documents = $this->firestore->collection("businesses")
    //             ->where('subscriptionId', '!=', 'goepos_free')
    //             ->limit($limit)
    //             ->documents();

    //         $data = [];
    //         $subscriptionsCache = [];

    //         // Collect ownerUid and subscriptionId pairs
    //         $batchRequests = [];
    //         foreach ($documents as $document) {
    //             if ($document->exists()) {
    //                 $ownerUid = $document['ownerUid'];
    //                 $subscriptionId = $document['subscriptionId'];
    //                 $batchRequests[] = [
    //                     'ownerUid' => $ownerUid,
    //                     'subscriptionId' => $subscriptionId,
    //                     'document' => $document
    //                 ];
    //             }
    //         }

    //         // Initialize Guzzle client
    //         $client = new Client();
    //         $promises = [];

    //         foreach ($batchRequests as $request) {
    //             $ownerUid = $request['ownerUid'];
    //             $subscriptionId = $request['subscriptionId'];

    //             // Create subscription request
    //             $promises["{$ownerUid}_{$subscriptionId}"] = $client->getAsync(
    //                 "https://firestore.googleapis.com/v1/projects/goepos-e9ad5/databases/(default)/documents/businesses/{$ownerUid}/subscriptions/{$subscriptionId}"
    //             );

    //             // Create monthly report request
    //             $promises["{$ownerUid}_monthly_report"] = $client->getAsync(
    //                 "https://firestore.googleapis.com/v1/projects/goepos-e9ad5/databases/(default)/documents/reports/{$ownerUid}/monthly/{$previousMonth}"
    //             );

    //             // Create daily report request
    //             $promises["{$ownerUid}_daily_report"] = $client->getAsync(
    //                 "https://firestore.googleapis.com/v1/projects/goepos-e9ad5/databases/(default)/documents/reports/{$ownerUid}/daily/{$previousDay}"
    //             );
    //         }

    //         // Wait for all promises to resolve
    //         $responses = Promise\settle($promises)->wait();

    //         foreach ($batchRequests as $request) {
    //             $ownerUid = $request['ownerUid'];
    //             $subscriptionId = $request['subscriptionId'];

    //             // Process subscription response
    //             $subscriptionKey = "{$ownerUid}_{$subscriptionId}";
    //             if (isset($responses[$subscriptionKey]['value']) && $responses[$subscriptionKey]['state'] === 'fulfilled') {
    //                 $subscriptionResponse = json_decode($responses[$subscriptionKey]['value']->getBody()->getContents(), true);
    //                 $subscriptionsCache[$ownerUid][$subscriptionId] = $subscriptionResponse['fields'];
    //             }

    //             $fields = $subscriptionsCache[$ownerUid][$subscriptionId] ?? [];
    //             $sku = $fields['sku'] ?? null;
    //             $expiration = isset($fields['expiration']) ? HelpersUtils::formatTimestamp($fields['expiration']) : null;

    //             $mergedDocument = $request['document']->data();
    //             $mergedDocument['sku'] = $sku;
    //             $mergedDocument['expiration'] = $expiration;
    //             $mergedDocument['createdAt'] = HelpersUtils::convertTimestampToDate($mergedDocument['createdAt']);
    //             // $mergedDocument['updatedAt'] = HelpersUtils::convertTimestampToDate($mergedDocument['updatedAt']) ?? '-';

    //             // Process monthly report response
    //             $monthlyReportKey = "{$ownerUid}_monthly_report";
    //             if (isset($responses[$monthlyReportKey]['value']) && $responses[$monthlyReportKey]['state'] === 'fulfilled') {
    //                 $monthlyReportResponse = json_decode($responses[$monthlyReportKey]['value']->getBody()->getContents(), true);
    //                 $cardTotal = $monthlyReportResponse['fields']['cardTotal'] ?? 0;
    //                 $cashTotal = $monthlyReportResponse['fields']['cashTotal'] ?? 0;
    //                 $qrisTotal = $monthlyReportResponse['fields']['qrisTotal'] ?? 0;

    //                 $numSales = $monthlyReportResponse['fields']['numSales'] ?? 0;
    //                 $numCredit = $monthlyReportResponse['fields']['numCredit'] ?? 0;
    //                 $numQris = $monthlyReportResponse['fields']['numQris'] ?? 0;
    //                 $numReturn = $monthlyReportResponse['fields']['numReturn'] ?? 0;

    //                 $mergedDocument['totalTrxQtyMonth'] = ($numQris + $numSales + $numCredit) - $numReturn;
    //                 $mergedDocument['totalTrxMonth'] = $cardTotal + $cashTotal + $qrisTotal;
    //             } else {
    //                 $mergedDocument['totalTrxMonth'] = 0;
    //                 $mergedDocument['totalTrxQtyMonth'] = 0;
    //             }

    //             // Process daily report response
    //             $dailyReportKey = "{$ownerUid}_daily_report";
    //             if (isset($responses[$dailyReportKey]['value']) && $responses[$dailyReportKey]['state'] === 'fulfilled') {
    //                 $dailyReportResponse = json_decode($responses[$dailyReportKey]['value']->getBody()->getContents(), true);
    //                 $dailyCardTotal = $dailyReportResponse['fields']['cardTotal'] ?? 0;
    //                 $dailyCashTotal = $dailyReportResponse['fields']['cashTotal'] ?? 0;
    //                 $dailyQrisTotal = $dailyReportResponse['fields']['qrisTotal'] ?? 0;

    //                 $dailyNumSales = $dailyReportResponse['fields']['numSales'] ?? 0;
    //                 $dailyNumCredit = $dailyReportResponse['fields']['numCredit'] ?? 0;
    //                 $dailyNumQris = $dailyReportResponse['fields']['numQris'] ?? 0;
    //                 $dailyNumReturn = $dailyReportResponse['fields']['numReturn'] ?? 0;

    //                 $mergedDocument['totalTrxQtyDay'] = ($dailyNumQris + $dailyNumSales + $dailyNumCredit) - $dailyNumReturn;
    //                 $mergedDocument['totalTrxDay'] = $dailyCardTotal + $dailyCashTotal + $dailyQrisTotal;
    //             } else {
    //                 $mergedDocument['totalTrxDay'] = 0;
    //                 $mergedDocument['totalTrxQtyDay'] = 0;
    //             }

    //             // Add the merged document to the data array
    //             $data[] = $mergedDocument;
    //         }

    //         return json_decode(json_encode($data), false);
    //     } catch (Exception $e) {
    //         Log::error('Error fetching businesses: ' . $e->getMessage());
    //         return [];
    //     }
    // }
    public function getBusinessesAll($limit)
    {
        try {
            // Calculate the previous month in the format 'YYYY-MM'
            $previousMonth = (new DateTime('first day of last month'))->format('Y-m');

            // Calculate the previous day in the format 'YYYY-MM-DD'
            $previousDay = (new DateTime('yesterday'))->format('Y-m-d');

            // Fetch business documents
            $documents = $this->firestore->collection("businesses")
                ->where('subscriptionId', '!=', 'goepos_free')
                ->limit($limit)
                ->documents();

            $data = [];
            $subscriptionsCache = [];

            // Collect ownerUid and subscriptionId pairs
            $batchRequests = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $ownerUid = $document['ownerUid'];
                    $subscriptionId = $document['subscriptionId'];
                    $batchRequests[] = [
                        'ownerUid' => $ownerUid,
                        'subscriptionId' => $subscriptionId,
                        'document' => $document
                    ];
                }
            }

            // Process batch requests
            foreach ($batchRequests as $request) {
                $ownerUid = $request['ownerUid'];
                $subscriptionId = $request['subscriptionId'];

                // Cache subscription fetch requests
                if (!isset($subscriptionsCache[$ownerUid][$subscriptionId])) {
                    $subscriptionDocs = $this->firestore->collection('businesses')
                        ->document($ownerUid)
                        ->collection('subscriptions')
                        ->document($subscriptionId)
                        ->snapshot();

                    if ($subscriptionDocs->exists()) {
                        $subscriptionsCache[$ownerUid][$subscriptionId] = $subscriptionDocs->data();
                    }
                }

                $fields = $subscriptionsCache[$ownerUid][$subscriptionId] ?? [];
                $sku = $fields['sku'] ?? null;
                $expiration = isset($fields['expiration']) ? HelpersUtils::formatTimestamp($fields['expiration']) : null;

                $mergedDocument = $request['document']->data();
                $mergedDocument['sku'] = $sku;
                $mergedDocument['expiration'] = $expiration;
                $mergedDocument['createdAt'] = HelpersUtils::convertTimestampToDate($mergedDocument['createdAt']);
                // $mergedDocument['updatedAt'] = HelpersUtils::convertTimestampToDate($mergedDocument['updatedAt']) ?? '-';

                // Fetch monthly report document
                $reportDoc = $this->firestore->collection('reports')
                    ->document($ownerUid)
                    ->collection('monthly')
                    ->document($previousMonth)
                    ->snapshot();

                if ($reportDoc->exists()) {
                    $cardTotal = $reportDoc->get('cardTotal') ?? 0;
                    $cashTotal = $reportDoc->get('cashTotal') ?? 0;
                    $qrisTotal = $reportDoc->get('qrisTotal') ?? 0;

                    $numSales = $reportDoc->get('numSales') ?? 0;
                    $numCredit = $reportDoc->get('numCredit') ?? 0;
                    $numQris = $reportDoc->get('numQris') ?? 0;
                    $numReturn = $reportDoc->get('numReturn') ?? 0;

                    $mergedDocument['totalTrxQtyMonth'] = ($numQris + $numSales + $numCredit) - $numReturn;
                    $mergedDocument['totalTrxMonth'] = $cardTotal + $cashTotal + $qrisTotal;
                } else {
                    $mergedDocument['totalTrxMonth'] = 0;
                    $mergedDocument['totalTrxQtyMonth'] = 0;
                }

                // Fetch daily report document
                $dailyReportDoc = $this->firestore->collection('reports')
                    ->document($ownerUid)
                    ->collection('daily')
                    ->document($previousDay)
                    ->snapshot();

                if ($dailyReportDoc->exists()) {
                    $dailyCardTotal = $dailyReportDoc->get('cardTotal') ?? 0;
                    $dailyCashTotal = $dailyReportDoc->get('cashTotal') ?? 0;
                    $dailyQrisTotal = $dailyReportDoc->get('qrisTotal') ?? 0;

                    $dailyNumSales = $dailyReportDoc->get('numSales') ?? 0;
                    $dailyNumCredit = $dailyReportDoc->get('numCredit') ?? 0;
                    $dailyNumQris = $dailyReportDoc->get('numQris') ?? 0;
                    $dailyNumReturn = $dailyReportDoc->get('numReturn') ?? 0;

                    $mergedDocument['totalTrxQtyDay'] = ($dailyNumQris + $dailyNumSales + $dailyNumCredit) - $dailyNumReturn;
                    $mergedDocument['totalTrxDay'] = $dailyCardTotal + $dailyCashTotal + $dailyQrisTotal;
                } else {
                    $mergedDocument['totalTrxDay'] = 0;
                    $mergedDocument['totalTrxQtyDay'] = 0;
                }

                // Add the merged document to the data array
                $data[] = $mergedDocument;
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
        $subscriptionsCache = [];
        $previousMonth = (new DateTime('first day of last month'))->format('Y-m');
        $previousDay = (new DateTime('yesterday'))->format('Y-m-d');

        $batchRequests = [];
        foreach ($documents as $document) {
            if ($document->exists()) {
                $ownerUid = $document['ownerUid'];
                $subscriptionId = $document['subscriptionId'];
                $batchRequests[] = [
                    'ownerUid' => $ownerUid,
                    'subscriptionId' => $subscriptionId,
                    'document' => $document
                ];
            }
        }

        foreach ($batchRequests as $request) {
            $ownerUid = $request['ownerUid'];
            $subscriptionId = $request['subscriptionId'];

            if (!isset($subscriptionsCache[$ownerUid][$subscriptionId])) {
                $subscriptionDocs = $this->firestore->collection('businesses')
                    ->document($ownerUid)
                    ->collection('subscriptions')
                    ->document($subscriptionId)
                    ->snapshot();

                if ($subscriptionDocs->exists()) {
                    $subscriptionsCache[$ownerUid][$subscriptionId] = $subscriptionDocs->data();
                }
            }

            $fields = $subscriptionsCache[$ownerUid][$subscriptionId] ?? [];
            $sku = $fields['sku'] ?? null;
            $expiration = isset($fields['expiration']) ? HelpersUtils::formatTimestamp($fields['expiration']) : null;

            $mergedDocument = $request['document']->data();
            $mergedDocument['sku'] = $sku;
            $mergedDocument['expiration'] = $expiration;
            $mergedDocument['createdAt'] = HelpersUtils::convertTimestampToDate($mergedDocument['createdAt']);
            // $mergedDocument['updatedAt'] = HelpersUtils::convertTimestampToDate($mergedDocument['updatedAt']) ?? '-';

            $reportDoc = $this->firestore->collection('reports')
                ->document($ownerUid)
                ->collection('monthly')
                ->document($previousMonth)
                ->snapshot();

            if ($reportDoc->exists()) {
                $cardTotal = $reportDoc->get('cardTotal') ?? 0;
                $cashTotal = $reportDoc->get('cashTotal') ?? 0;
                $qrisTotal = $reportDoc->get('qrisTotal') ?? 0;

                $numSales = $reportDoc->get('numSales') ?? 0;
                $numCredit = $reportDoc->get('numCredit') ?? 0;
                $numQris = $reportDoc->get('numQris') ?? 0;
                $numReturn = $reportDoc->get('numReturn') ?? 0;

                $mergedDocument['totalTrxQtyMonth'] = ($numQris + $numSales + $numCredit) - $numReturn;
                $mergedDocument['totalTrxMonth'] = $cardTotal + $cashTotal + $qrisTotal;
            } else {
                $mergedDocument['totalTrxMonth'] = 0;
                $mergedDocument['totalTrxQtyMonth'] = 0;
            }

            $dailyReportDoc = $this->firestore->collection('reports')
                ->document($ownerUid)
                ->collection('daily')
                ->document($previousDay)
                ->snapshot();

            if ($dailyReportDoc->exists()) {
                $dailyCardTotal = $dailyReportDoc->get('cardTotal') ?? 0;
                $dailyCashTotal = $dailyReportDoc->get('cashTotal') ?? 0;
                $dailyQrisTotal = $dailyReportDoc->get('qrisTotal') ?? 0;

                $dailyNumSales = $dailyReportDoc->get('numSales') ?? 0;
                $dailyNumCredit = $dailyReportDoc->get('numCredit') ?? 0;
                $dailyNumQris = $dailyReportDoc->get('numQris') ?? 0;
                $dailyNumReturn = $dailyReportDoc->get('numReturn') ?? 0;

                $mergedDocument['totalTrxQtyDay'] = ($dailyNumQris + $dailyNumSales + $dailyNumCredit) - $dailyNumReturn;
                $mergedDocument['totalTrxDay'] = $dailyCardTotal + $dailyCashTotal + $dailyQrisTotal;
            } else {
                $mergedDocument['totalTrxDay'] = 0;
                $mergedDocument['totalTrxQtyDay'] = 0;
            }

            $data[] = $mergedDocument;
        }

        return json_decode(json_encode($data), false);
    } catch (Exception $e) {
        // Log::error('Error fetching businesses: ' . $e->getMessage());
        return [];
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
            $collection = $this->firestore->collection("businesses")->document($ownerUid)->collection('staffs');
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
    public function getSubmissionByOwnerUid($ownerUid)
    {
        try {
            $collection = $this->firestore->collection("bankAccounts")->document($ownerUid)->collection('submission');
            $documents = $collection->documents();

            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = [
                        'id' => $document->id(),  // ID dokumen
                        'data' => $document->data()  // Data dokumen
                    ];
                }
            }
            return json_decode(json_encode($data), false);
        } catch (Exception $e) {
            // Tangani kesalahan jika ada
            // Log::error('Error fetching submission by owner UID: ' . $e->getMessage());
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
            // 'createdAt' => new Timestamp($timestamp),
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
            'pending_qris_amount' => 0,
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
    public function activateQrisBaru($ownerUid, $timestamp,$paymentMethod,$submission_id)
    {
        $qris = [
            'activationStatus' => 'active',
            'activationStatusNote' => 'Syarat Terpenuhi',
            'activeAt' => new Timestamp($timestamp),
            'category' => [
                'name' => 'QRIS',
                'type' => 'qris',
            ],
            // 'createdAt' => new Timestamp($timestamp),
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
            'pending_qris_amount' => 0,
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

            $this->firestore->collection('bankAccounts')->document($ownerUid)
                    ->collection('submission')
                    ->document($submission_id)
                    ->update([
                        ['path' => 'status', 'value' => 'active']
                    ]);

            return 'Document updated successfully.';
        } catch (\Exception $e) {
            return 'Error updating document: ' . $e->getMessage();
        }
    }

    public function createBankAccount($ownerUid,$data,$paymentId,$submission_id){

        $bankAccount = [
            'ownerUid' => $ownerUid,
            'bankType' => $data['bankShortCode'],
            'accountNumber' => aes256Encrypt($data['bankNumber'],config('services.secretKeyBank.secretKey')),
            'nameAccount' => $data['nameAccount'],
        ];

        $timestamp = Carbon::now();

        try {

            $this->firestore->collection('bankAccounts')
                    ->document($ownerUid)
                    ->set($bankAccount);

            $this->activateQrisBaru($ownerUid,$timestamp,$paymentId,$submission_id);

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
                // Cek apakah 'bankType' ada dan telah didefinisikan
                if (isset($document->data()['bankType'])) {
                    $data = [
                        'bankType' => $document->data()['bankType'],
                        'accountNumber' => aes256Decrypt($document->data()['accountNumber'], config('services.secretKeyBank.secretKey')),
                        'nameAccount' => $document->data()['nameAccount'],
                    ];

                    // Convert array to object dan kembalikan data
                    return json_decode(json_encode($data));
                } else {
                    return false;  // Jika 'bankType' undefined, kembalikan false
                }
            } else {
                return false;  // Jika dokumen tidak ada, kembalikan false
            }
        } catch (\Exception $e) {
            // Kembalikan pesan error jika terjadi exception
            return 'Error getting document: ' . $e->getMessage();
        }



    }

    public function disabledQrisByGoepos($ownerUid){

        try {
            $this->firestore->collection('businesses')->document($ownerUid)->update([
                ['path' => 'qris.enabledByGoePos', 'value' => false],
            ]);

            return true;
        } catch (\Exception $e) {
            return 'Error disabling QRIS: ' . $e->getMessage();
        }

    }

    public function activedQrisByGoepos($ownerUid){

        try {
            $this->firestore->collection('businesses')->document($ownerUid)->update([
                ['path' => 'qris.enabledByGoePos', 'value' => true],
            ]);

            return true;
        } catch (\Exception $e) {
            return 'Error disabling QRIS: ' . $e->getMessage();
        }

    }

    public function rejectSubmission($ownerUid, $submission_id)
    {
        try {
            // Update status pengajuan menjadi 'rejected'
            $this->firestore->collection('bankAccounts')->document($ownerUid)
                ->collection('submission')
                ->document($submission_id)
                ->update([
                    ['path' => 'status', 'value' => 'rejected']
                ]);

            // Update status aktivasi QRIS menjadi 'rejected' dengan catatan
            $this->firestore->collection('businesses')->document($ownerUid)
                ->update([
                    ['path' => 'qris.activationStatus', 'value' => 'rejected'],
                    ['path' => 'qris.activationStatusNote', 'value' => 'Nama yang tercantum di KTP tidak sama']
                ]);

            return true;
        } catch (\Exception $e) {
            // Sebaiknya tambahkan logging untuk pengecualian jika perlu
            // Log::error('Error disabling QRIS: ' . $e->getMessage());

            return 'Error disabling QRIS: ' . $e->getMessage();
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
