<?php

namespace App\Validators;

use Validator;

class AuthValidator
{
    
    // validate login page function
    public function loginValidator()
    {   
        return new RequestValidator()->validate(
        request()->all() ,
        [
            "username" => "string|required|max:20" ,
            "password" => "string|required|min:8"
        ]);
    }
    // validate register page function
    public function registerValidator()
    {   
        return new RequestValidator()->validate(
        request()->all() ,
        [
            "username" => "string|required|max:20|unique:users" ,
            "email" => "email|required|unique:users" ,
            "password" => "string|min:8" ,
            "role" => "int|max:3|required|"
        ]);
    }
}
