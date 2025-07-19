<?php

namespace App\Http\Controllers\Validator;

use App\Http\Controllers\Controller;
use Validator;

class ProductValidator extends Controller
{
    // Validate method is a general function to validate product routes and it returns an array named status
    public function Validate(array $rules , array $request)
    {
        $validator = Validator::make(
           $request ,
           $rules
        );

        // return the validation status and errors
        return $validator->fails()
        ? ["status" => false , "errors" => $validator->errors()]
        : ["status" => true];
    }
    
    // Validate post method request 
    public function GetValidator()
    {
        return new ProductValidator()->Validate([
            "id" => "required|numeric"
        ],
        ["id" => request()->route('id')]
        );
    }

    // Validate post method request 
    public function PostValidator()
    {
        return new ProductValidator()->Validate([
            "title" => "required|string|max:20|unique:products" ,
            "imageUrl" => "required|url"  ,
            "description" => "required|string|max:100" ,
            "price" => "required|numeric|min:15" ,
            "products_count" => "required|integer|min:0" ,
        ] ,
        request()->all()
        );
    }

    // validate put method request
    public function PutValidator()
    {
        return new ProductValidator()->Validate([
            "id" => "required|numeric" ,
            "title" => "string|max:20|unique:products" ,
            "imageUrl" => "url"  ,
            "description" => "string|max:100" ,
            "price" => "numeric|min:0" ,
            "products_count" => "integer|min:0" ,
        ] ,
        request()->all()
        );
    }

    public function DeleteValidator()
    {
        return new ProductValidator()->Validate([
            "id" => "required|numeric|max:7"
        ] ,
        request()->all()
        );
    }
}
