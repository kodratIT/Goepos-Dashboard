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

                $lastLogin = $this->firestore->collection('reports')
                    ->document($ownerUid)
                    ->snapshot();

                if ($lastLogin->exists() && isset($lastLogin['updatedAt'])) {
                    $mergedDocument['lastLogin'] = HelpersUtils::convertTimestampToDate($lastLogin['updatedAt']);
                } else {
                    $mergedDocument['lastLogin'] = null;
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


    public function getAllTransactionQris($limit = 50, $startAfter = null)
    {
        try {
            // Mendapatkan referensi koleksi 'qris' dan mengurutkan berdasarkan ID dokumen secara descending
            $collectionReference = $this->firestore->collection("referenceWebhook")
                                                   ->document("transactions")
                                                   ->collection("qris")
                                                   ->orderBy('id', 'DESC') // Mengurutkan berdasarkan ID dokumen
                                                   ->limit($limit); // Batasi jumlah dokumen

            // Jika menggunakan pagination, mulai setelah ID tertentu
            if ($startAfter) {
                $collectionReference = $collectionReference->startAfter($startAfter);
            }

            $documents = $collectionReference->documents();

            // Inisialisasi array untuk menampung data
            $data = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $data[] = $document->data();
                }
            }

            // Kembalikan data sebagai objek JSON
            return (object) ['data' => $data];
        } catch (Exception $e) {
            // Log kesalahan dengan pesan spesifik
            Log::error('Error fetching QRIS transactions: ' . $e->getMessage());

            // Kembalikan array kosong dalam format objek JSON
            return (object) ['data' => []];
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

    public function getAllNotifications($limit) {
        $collection = $this->firestore->collection('notifications');

        // Urutkan berdasarkan createdAt dalam urutan descending
        $query = $collection->orderBy('createdAt', 'DESC')->limit($limit);
        $documents = $query->documents();

        $notifications = [];

        foreach ($documents as $document) {
            if ($document->exists()) {
                $notifications[] = $this->mapNotificationData($document);
            }
        }

        return json_encode($notifications);
    }


    private function mapNotificationData($document) {
        $data = $document->data();

        // Memetakan data message jika ada
        $message = isset($data['message']) ? array_map(function($msg) {
            return [
                'lang' => $msg['lang'] ?? NULL,
                'text' => $msg['text'] ?? NULL,
                'actionText' => $msg['actionText'] ?? NULL,
                'action' => $msg['action'] ?? NULL,
                'actionTextStyle' => $msg['actionTextStyle'] ?? NULL,
                'actionTextColor' => $msg['actionTextColor'] ?? NULL
            ];
        }, $data['message']) : NULL;

        // Memetakan data title jika ada
        $title = isset($data['title']) ? array_map(function($ttl) {
            return [
                'lang' => $ttl['lang'] ?? NULL,
                'text' => $ttl['text'] ?? NULL
            ];
        }, $data['title']) : NULL;

        return [
            'id' => $document->id(),
            'background' => $data['background'] ?? NULL,
            'createdAt' => formatTanggal($data['createdAt']) ?? NULL,
            'icon' => $data['icon'] ?? NULL,
            'iconColor' => $data['iconColor'] ?? NULL,
            'backgroundIconColor' => $data['backgroundIconColor'] ?? NULL,
            'message' => $message,
            'messageColor' => $data['messageColor'] ?? NULL,
            'title' => $title,
            'titleColor' => $data['titleColor'] ?? NULL,
            'showUntil' => $data['showUntil'] ?? NULL,
            'type' => $data['type'] ?? NULL,
            'action' => $data['action'] ?? NULL,
            'actionText' => $data['actionText'] ?? NULL
        ];
    }

    public function createNotifications($data, $specificTarget, $ownerUids)
    {
        // Tambahkan variabel kontrol untuk memastikan dokumen hanya dibuat sekali
        static $isDocumentCreated = false;

        // Jika dokumen sudah dibuat sebelumnya, batalkan operasi
        if ($isDocumentCreated) {
            return false;
        }

        $businesses = [];
        if ($specificTarget == "subscription") {
            $documents = $this->firestore->collection("businesses")
                        ->where('subscriptionId', '!=', 'goepos_free')
                        ->documents();

            foreach ($documents as $document) {
                if ($document->exists()) {
                    $businesses[] = $document->data();
                }
            }
        }

        try {
            // Tambahkan dokumen baru ke koleksi utama
            $collection = $this->firestore->collection('notifications');
            $document = $collection->add($data);

            // Set variabel kontrol menjadi true untuk menghindari duplikasi
            $isDocumentCreated = true;

            // Update dokumen dengan ID yang baru saja dibuat
            $documentId = $document->id();
            $collection->document($documentId)->update([
                ['path' => 'id', 'value' => $documentId]
            ]);

            if ($specificTarget == "subscription") {
                foreach ($businesses as $business) {
                    $document = $this->firestore->collection('businesses')
                                    ->document($business['ownerUid'])
                                    ->collection('notifications')
                                    ->document($documentId);

                    $document->set([
                        'id' => $documentId,
                        'show' => true,
                        'createdAt' => Carbon::now(),
                        'type' => 'specific',
                    ]);
                }
            } elseif ($specificTarget == "user_only") {
                foreach ($ownerUids as $ownerUid) {
                    $document = $this->firestore->collection('businesses')
                                    ->document($ownerUid)
                                    ->collection('notifications')
                                    ->document($documentId);

                    $document->set([
                        'id' => $documentId,
                        'show' => true,
                        'createdAt' => Carbon::now(),
                        'type' => 'specific',
                    ]);
                }
            }

            return true;
        } catch (GoogleException $e) {
            Log::error('Failed to add notification to Firestore: ' . $e->getMessage());
            return false;
        }
    }

    public function findNotificationById($id)
    {
        // Mengakses koleksi 'notifications' dan mengambil dokumen berdasarkan ID
        $docRef = $this->firestore->collection('notifications')->document($id);
        $snapshot = $docRef->snapshot();

        // Cek apakah dokumen ditemukan
        if ($snapshot->exists()) {
            return $snapshot->data(); // Mengembalikan data sebagai array
        } else {
            return null; // Kembalikan null jika dokumen tidak ditemukan
        }
    }

    public function updateNotification($data, $specificTarget, $ownerUids = []) {

        // Periksa apakah dokumen dengan ID yang diberikan ada
        $documentId = $data['id'];
        $collection = $this->firestore->collection('notifications');
        $document = $collection->document($documentId);

        if (!$document->snapshot()->exists()) {
            Log::error("Dokumen dengan ID $documentId tidak ditemukan.");
            return false;
        }

        try {
            // Perbarui data di koleksi utama 'notifications'
            $document->update([
                ['path' => 'backgroundIconColor', 'value' => $data['backgroundIconColor'] ?? ''],
                ['path' => 'iconColor', 'value' => $data['iconColor'] ?? ''],
                ['path' => 'background', 'value' => $data['background'] ?? ''],
                ['path' => 'icon', 'value' => $data['icon'] ?? ''],
                ['path' => 'message', 'value' => $data['message'] ?? []],
                ['path' => 'messageColor', 'value' => $data['messageColor'] ?? ''],
                ['path' => 'title', 'value' => $data['title'] ?? []],
                ['path' => 'titleColor', 'value' => $data['titleColor'] ?? ''],
                ['path' => 'showUntil', 'value' => $data['showUntil'] ?? null],
                ['path' => 'type', 'value' => $data['type']],
                ['path' => 'updatedAt', 'value' => Carbon::now()]
            ]);

            if ($specificTarget == "subscription") {
                // Ambil dokumen bisnis dengan subscription aktif
                $documents = $this->firestore->collection("businesses")
                            ->where('subscriptionId', '!=', 'goepos_free')
                            ->documents();

                $businesses = [];
                foreach ($documents as $businessDoc) {
                    if ($businessDoc->exists()) {
                        $businesses[] = $businessDoc->data();
                    }
                }

                // Perbarui notifikasi di subkoleksi businesses/{ownerUid}/notifications
                foreach ($businesses as $business) {
                    try {
                        $this->firestore->collection('businesses')
                            ->document($business['ownerUid'])
                            ->collection('notifications')
                            ->document($documentId)
                            ->set([
                                'id' => $documentId,
                                'show' => true,
                                'createdAt' => Carbon::now(),
                                'type' => 'specific'
                            ], ['merge' => true]);
                    } catch (GoogleException $e) {
                        Log::error("Failed to update notification for business {$business['ownerUid']}: " . $e->getMessage());
                    }
                }
            } elseif ($specificTarget == "user_only") {
                // Perbarui notifikasi di subkoleksi untuk pengguna tertentu
                foreach ($ownerUids as $ownerUid) {
                    try {
                        $this->firestore->collection('businesses')
                            ->document($ownerUid)
                            ->collection('notifications')
                            ->document($documentId)
                            ->set([
                                'id' => $documentId,
                                'show' => true,
                                'createdAt' => Carbon::now(),
                                'type' => 'specific'
                            ], ['merge' => true]);
                    } catch (GoogleException $e) {
                        Log::error("Failed to update notification for user {$ownerUid}: " . $e->getMessage());
                    }
                }
            }

            return true;
        } catch (GoogleException $e) {
            Log::error('Failed to update notification in Firestore: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteNotification($id)
    {
        try {
            $this->firestore->collection('notifications')->document($id)->delete();
            return true;
        } catch (\Exception $e) {

            return false;
            // Opsional: Log error untuk debugging
            \Log::error('Error saat menghapus notifikasi:', ['error' => $e->getMessage()]);
        }
    }



}
