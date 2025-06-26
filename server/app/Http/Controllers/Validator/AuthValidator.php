<?php

namespace App\Http\Controllers\Validator;

use Illuminate\Http\Request;
use Validator;

class AuthValidator 
{
    public $request;
    public $validator;

    // Validating user data at the selected page
    function __construct(Request $request)
    {
        $this->request = $request;
    } 
    
    // validate login page function
    public function ValidateLogin()
    {   
        $validate = Validator::make(
            $this->request->all() ,
            [
                "username" => "string|required|max:20" ,
                "password" => "string|required|min:8"
            ]
        );
        return $validate->fails() 
        ? ["status" =>false ,"errors" => $validate->errors()]
        : ["status" => true , "body" => $validate->getData()];
    }
    // validate register page function
    public function ValidateRegister()
    {   
        $validate = Validator::make(
            $this->request->all() ,
            [
                "username" => "string|required|max:20|unique:users" ,
                "email" => "email|required|unique:users" ,
                "password" => "string|min:8"
            ]
        );
        return $validate->fails() 
        ? ["status" =>false ,"errors" => $validate->errors()]
        : ["status" => true , "body" => $validate->getData()];
    }
}
