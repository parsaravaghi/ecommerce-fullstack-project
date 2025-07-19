<?php

namespace App\Http\Controllers\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AuthValidator 
{
    public $validator;
    
    // validate login page function
    public function ValidateLogin(Request $request)
    {   
        $validator = Validator::make(
            $request->all() ,
            [
                "username" => "string|required|max:20" ,
                "password" => "string|required|min:8"
            ]
        );
        return $validator->fails() 
        ? ["status" =>false ,"errors" => $validator->errors()]
        : ["status" => true , "body" => $validator->getData()];
    }
    // validate register page function
    public function ValidateRegister(Request $request)
    {   
        $validator = Validator::make(
            $request->all() ,
            [
                "username" => "string|required|max:20|unique:users" ,
                "email" => "email|required|unique:users" ,
                "password" => "string|min:8"
            ]
        );
        return $validator->fails() 
        ? ["status" =>false ,"errors" => $validator->errors()]
        : ["status" => true , "body" => $validator->getData()];
    }
}
