<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
            $format1 = \DateTime::createFromFormat('H:i:s', $value);
            $format2 = \DateTime::createFromFormat('H:i', $value);

            // If neither format matches, fail the validation
            if (!$format1 && !$format2) {
                $fail($attribute . ' is not a valid time format (H:i or H:i:s).');
            }
    }
}
