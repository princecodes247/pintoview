<?php

namespace App\Services;

use GuzzleHttp\Client;

class CryptomusService
{
    protected $client;
    protected $apiKey;
    protected $merchantId;
    protected $callbackUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('CRYPTOMUS_API_KEY');
        $this->merchantId = env('CRYPTOMUS_MERCHANT_ID');
        $this->callbackUrl = env('CRYPTOMUS_CALLBACK_URL');
    }

    public function createPayment($amount, $currency = 'USD')
    {
        $response = $this->client->post('https://api.cryptomus.com/v1/payment', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => [
                'merchant_id' => $this->merchantId,
                'amount' => $amount,
                'currency' => $currency,
                'callback_url' => $this->callbackUrl,
                'success_url' => env('CRYPTOMUS_SUCCESS_URL'),
                'fail_url' => env('CRYPTOMUS_FAIL_URL'),
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function verifyPayment($paymentId)
    {
        $response = $this->client->get("https://api.cryptomus.com/v1/payment/{$paymentId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
