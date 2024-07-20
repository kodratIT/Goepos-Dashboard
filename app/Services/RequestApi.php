<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Exception\RequestException;

class RequestApi
{
    public function getToken()
    {
        // Guzzle HTTP client untuk melakukan permintaan ke API
        $client = new Client();

         // $hash = config('services.brick');
         $credentials = config('services.brick');

         // Mengdekripsi kredensial
        $clientId = Crypt::decryptString(config('services.brick.client_id'));
        $secretId = Crypt::decryptString(config('services.brick.secret_id'));


        // Endpoint untuk mendapatkan token
        $endpoint = 'https://api.onebrick.io/v2/payments/auth/token';


        $authorization = base64_encode($clientId.":".$secretId);


        try {
            // Melakukan permintaan GET untuk mendapatkan token
            $response = $client->request('GET', $endpoint, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => "Basic $authorization",
                    'username' => $clientId,
                    'password' => $secretId,
                ],
            ]);

            // Mendekode respons JSON
            $result = json_decode($response->getBody(), true);

            // Mengembalikan token
            return $result['data']['accessToken'];
        } catch (RequestException $e) {
            // Log error
            Log::error('Failed to get token: ' . $e->getMessage());

            // Menangani jika terjadi kesalahan saat melakukan permintaan ke API
            return false;
        }
    }

    public function checkValidatedBankAccount($data)
    {
        // Mendapatkan token
        $token = $this->getToken();

        Log::error($token);

        if (!$token) {
            // Menangani jika token tidak dapat diperoleh
            Log::error('Token is not available.');
            return false;
        }

        // Guzzle HTTP client untuk melakukan permintaan ke API disbursement
        $client = new Client();

        // Endpoint API disbursement
        $endpoint = 'https://api.onebrick.io/v2/payments/gs/bank-account-validation';

        // Data yang akan dikirim ke API
        $params = [
            'accountNumber' => $data['bankNumber'],
            'bankShortCode' => $data['bankShortCode'],
        ];


        try {
            // Melakukan permintaan GET ke API
            $response = $client->request('GET', $endpoint, [
                'query' => $params,
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'publicAccessToken' => "Bearer $token",
                ],
            ]);

            // Mendekode hasil dari respons
            $result = json_decode($response->getBody(), true);

            // Memeriksa status dari hasil respons
            if ($result['status'] === 200) {
                return true;  // Akun bank valid
            } else {
                Log::error('Bank account is not valid: ' . json_encode($result));
                return false; // Akun bank tidak valid
            }
        } catch (RequestException $e) {
            // Log error
            Log::error('Failed to validate bank account: ' . $e->getMessage());

            // Menangani jika terjadi kesalahan saat melakukan permintaan ke API
            return false;
        }
    }
}
