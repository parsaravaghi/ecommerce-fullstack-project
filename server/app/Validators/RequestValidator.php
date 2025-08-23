<?php

namespace App\Validators;

use Validator;

class RequestValidator
{
    // Validate method is a general function to validate product routes and it returns an array named status
    public function validate(array $request, array $rules)
    {
        $validator = Validator::make(
           $request ,
           $rules
        );

        // return the validation status and errors
        return $validator->fails()
        ? ["status" => false , "errors" => ["errors" => $validator->errors()]]
        : ["status" => true];
    }
}
