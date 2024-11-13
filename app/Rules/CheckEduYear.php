<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckEduYear implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regax = "/^[0-9]{4}\-[0-9]{4}$/";

        if (!preg_match($regax, $value)) {
            $fail('The education year must be in the format YYYY-YYYY.');
        }
    }
}
