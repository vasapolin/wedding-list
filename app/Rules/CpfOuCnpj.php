<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfOuCnpj implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $digits = preg_replace('/\D/', '', (string) $value);

        $isValid = match (strlen($digits)) {
            11 => $this->isValidCpf($digits),
            14 => $this->isValidCnpj($digits),
            default => false,
        };

        if (! $isValid) {
            $fail('Informe um CPF ou CNPJ válido.');
        }
    }

    protected function isValidCpf(string $digits): bool
    {
        if (preg_match('/^(\d)\1{10}$/', $digits)) {
            return false;
        }

        foreach ([9, 10] as $length) {
            $sum = 0;
            for ($i = 0; $i < $length; $i++) {
                $sum += (int) $digits[$i] * (($length + 1) - $i);
            }
            $check = ((10 * $sum) % 11) % 10;
            if ($check !== (int) $digits[$length]) {
                return false;
            }
        }

        return true;
    }

    protected function isValidCnpj(string $digits): bool
    {
        if (preg_match('/^(\d)\1{13}$/', $digits)) {
            return false;
        }

        $weightsFirst = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $weightsSecond = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        foreach ([[12, $weightsFirst], [13, $weightsSecond]] as [$position, $weights]) {
            $sum = 0;
            foreach ($weights as $i => $weight) {
                $sum += (int) $digits[$i] * $weight;
            }
            $remainder = $sum % 11;
            $check = $remainder < 2 ? 0 : 11 - $remainder;
            if ($check !== (int) $digits[$position]) {
                return false;
            }
        }

        return true;
    }
}
