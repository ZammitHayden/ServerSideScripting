<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmailValidationService
{
    private const API_KEY = '669e2ad834d348fd8cd8ce0c682e8315';

    public static function isValid(string $email): bool
    {
        $response = Http::get('https://emailreputation.abstractapi.com/v1/', [
            'api_key' => self::API_KEY,
            'email' => $email,
        ]);

        if (!$response->successful()) {
            return false;
        }

        $data = $response->json();

        return
            ($data['email_deliverability']['status'] ?? '') === 'deliverable' &&
            ($data['email_quality']['is_disposable'] ?? true) === false &&
            ($data['email_risk']['address_risk_status'] ?? '') === 'low';
    }
}
