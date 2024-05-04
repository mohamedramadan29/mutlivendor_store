<?php

namespace App\Services;

use GuzzleHttp\Client;

class TapPaymentService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.tap.company/v2/',
            'timeout'  => 10,
        ]);
    }

    public function createInvoice($data)
    {
        $response = $this->client->request('POST', 'invoices', [
            'json' => $data,
            'headers' => [
                'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
