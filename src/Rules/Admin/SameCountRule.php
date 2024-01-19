<?php

namespace AdminDatabaseProvider\Rules\Admin;

use Closure;
use Illuminate\Validation\Validator;

class SameCountRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param array|Closure $div
     * @param Validator $validator
     * @return bool
     */
    public function validate(string $attribute, array $value, array|Closure $div, Validator $validator): bool
    {
        $requestData = $validator->getData();

        if (!is_array($div) || !isset($requestData[$div[0]]) || !is_array($requestData[$div[0]])) {
            $validator->errors()->add($attribute, 'The number of values does not match the number of columns!');

            return false;
        }

        return count($value) === count($requestData[$div[0]]);
    }
}
