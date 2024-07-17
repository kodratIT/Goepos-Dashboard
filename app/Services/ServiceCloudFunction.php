<?php

namespace App\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\StaffModel;
use Kreait\Firebase\Factory;
use App\Models\BusinessesModel;
use Google\Cloud\Core\Timestamp;
use Kreait\Firebase\Contract\Firestore;

class ServiceCloudFunction
{

    public function createTransferPayment($request)
    {
        $json_decode = json_decode($request, true);
        $client = new Client();

        $data = [
            'ownerUID' => $json_decode['ownerUID'],
            'ownerEmail' => $json_decode['ownerEmail'],
            'bankName' => $json_decode['bankName'],
            'bankNumber' => $json_decode['bankNumber'],
            'bankHolderName' => $json_decode['bankHolderName'],
            'amount' => $json_decode['amount'],
            'feeTrx' => $json_decode['feeTrx'],
            'feeTransfer' => $json_decode['feeTransfer'],
            'paymentMethod' => $json_decode['paymentMethod']
        ];

        try {
            $response = $client->request('POST', 'https://us-central1-goepos-e9ad5.cloudfunctions.net/createTransferPayment', [
                'json' => $data
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody(), true);

            if ($statusCode == 200) {
                return true;
            } else {
                return response()->json(['success' => false, 'data' => $responseBody], $statusCode);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

}
}
