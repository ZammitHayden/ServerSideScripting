<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmailValidationService
{
    private const API_KEY = '669e2ad834d348fd8cd8ce0c682e8315';

    /**
     * Determine whether an email address is considered valid based on
     * Abstract API's Email Validation service.
     *
     * Function returns true only if:
     *  - the email is marked as "deliverable" - Meaning it can receive emails
     *  - the email is not disposable - Meaning a temporary or throwaway email address
     *  - the email has a "low" risk status - Indicating it is unlikely to be associated with fraudulent activity example Spam
     *
     * In all other cases—including API failure—it returns false.
     *
     * @param string $email
     * @return bool
     */

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
