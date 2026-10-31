<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class FlutterwaveService
{
    protected string $baseUrl = 'https://api.flutterwave.com/v3';

    protected function request()
    {
        $secretKey = config('services.flutterwave.secret_key');

        if (empty($secretKey)) {
            throw new RuntimeException('Flutterwave secret key is not configured.');
        }

        return Http::withToken($secretKey)
            ->acceptJson()
            ->timeout(30);
    }

    public function createPayment(array $data): array
    {
        $response = $this->request()->post(
            $this->baseUrl . '/payments',
            $data
        );

        $response->throw();

        $result = $response->json();

        if (($result['status'] ?? null) !== 'success') {
            throw new RuntimeException(
                $result['message'] ?? 'Unable to initialize payment.'
            );
        }

        return $result['data'];
    }

    public function verifyPayment(string $transactionId): array
    {
        $response = $this->request()->get(
            $this->baseUrl . '/transactions/' . urlencode($transactionId) . '/verify'
        );

        $response->throw();

        return $response->json('data') ?? [];
    }
}
