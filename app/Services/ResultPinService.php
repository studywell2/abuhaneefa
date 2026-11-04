<?php

namespace App\Services;

use Illuminate\Support\Str;
use InvalidArgumentException;

class ResultPinService
{
    /**
     * Generate a random 12-digit result PIN.
     */
    public function generatePin(): string
    {
        return (string) random_int(100000000000, 999999999999);
    }

    /**
     * Hash a PIN before storing it in the database.
     */
    public function hashPin(string $pin): string
    {
        return hash_hmac('sha256', $pin, config('app.key'));
    }

    /**
     * Verify a PIN against its stored hash.
     */
    public function verifyPin(string $pin, string $storedHash): bool
    {
        return hash_equals($storedHash, $this->hashPin($pin));
    }

    /**
     * Calculate the next academic term.
     *
     * Supported terms:
     * First, Second, Third.
     */
    public function getNextTerm(
        string $academicYear,
        string $term
    ): array {
        $terms = ['First', 'Second', 'Third'];

        if (!in_array($term, $terms, true)) {
            throw new InvalidArgumentException(
                'Invalid academic term. Use First, Second, or Third.'
            );
        }

        if (!preg_match('/^(\d{4})\/(\d{4})$/', $academicYear, $matches)) {
            throw new InvalidArgumentException(
                'Invalid academic year format. Expected YYYY/YYYY.'
            );
        }

        $startYear = (int) $matches[1];
        $endYear = (int) $matches[2];

        if ($endYear !== $startYear + 1) {
            throw new InvalidArgumentException(
                'The academic year must contain two consecutive years.'
            );
        }

        $termIndex = array_search($term, $terms, true);

        if ($termIndex < 2) {
            return [
                'academic_year' => $academicYear,
                'term' => $terms[$termIndex + 1],
            ];
        }

        $nextStartYear = $startYear + 1;
        $nextEndYear = $endYear + 1;

        return [
            'academic_year' => $nextStartYear . '/' . $nextEndYear,
            'term' => 'First',
        ];
    }

    /**
     * Calculate the two-term validity period for a PIN.
     */
    public function getTwoTermPeriod(
        string $startAcademicYear,
        string $startTerm
    ): array {
        $endPeriod = $this->getNextTerm(
            $startAcademicYear,
            $startTerm
        );

        return [
            'start_academic_year' => $startAcademicYear,
            'start_term' => $startTerm,
            'end_academic_year' => $endPeriod['academic_year'],
            'end_term' => $endPeriod['term'],
        ];
    }
}
