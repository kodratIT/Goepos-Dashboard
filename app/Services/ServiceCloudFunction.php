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

    public function createTransferPayment($data)
    {
        $client = new Client();

        $data = [
            'ownerUID' => $data->ownerUID,
            'ownerEmail' => $data->ownerEmail,
            'bankName' => $data->bankName,
            'bankNumber' => $data->bankNumber,
            'bankHolderName' => $data->bankHolderName,
            'amount' => $data->amount,
            'feeTrx' => $data->feeTrx,
            'feeTransfer' => $data->feeTransfer,
            'paymentMethod' => $data->paymentMethod
        ];

        try {
            $response = $client->request('POST', 'https://us-central1-goepos-e9ad5.cloudfunctions.net/createTransferPayment', [
                'json' => $data
            ]);

            $responseBody = json_decode($response->getBody(), true);
            return response()->json($responseBody);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

}
}
