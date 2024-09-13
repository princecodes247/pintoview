<?php

namespace App\Services;

use GuzzleHttp\Client;

class CryptomusService
{
    protected $client;
    protected $paymentKey;
    protected $merchantId;
    protected $callbackUrl;
    protected $payment;

    public function __construct()
    {
        $this->client = new Client();
        $this->paymentKey = env('CRYPTOMUS_PAYMENT_KEY');
        $this->merchantId = env('CRYPTOMUS_MERCHANT_ID');
        $this->callbackUrl = env('CRYPTOMUS_CALLBACK_URL');
        $this->payment = \Cryptomus\Api\Client::payment($this->paymentKey, $this->merchantId);
    }

    public function createPayment($amount, $currency = 'USD')
    {
        $result = $this->payment->create([
            'amount' => '16',
            'currency' => 'USD',
            'network' => 'ETH',
            'order_id' => '555123',
            'url_return' => 'https://example.com/return',
            'url_callback' => 'https://example.com/callback',
            'is_payment_multiple' => false,
            'lifetime' => '7200',
            'to_currency' => 'ETH'
        ]);

        return json_decode($result, true);
    }

    public function getPaymentInfo($paymentId)
    {
        $data = ["order_id" => "12345"];

        $result = $this->payment->info($data);
        return json_decode($result, true);
    }

    public function verifyPayment($paymentId)
    {
        $response = $this->client->get("https://api.cryptomus.com/v1/payment/{$paymentId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->paymentKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
