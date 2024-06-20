<?php

namespace App\Rules;

use App\Models\Question;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SameQuestionRules implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if ($this->validationRule($value)) {
            $fail('Question already exists!');
        }
    }

    private function validationRule($value): bool
    {
        return Question::whereQuestion($value)->exists();
    }
}
