<?php

namespace App\Validators;

use Validator;

class ProductValidator
{
    // Validate post method request 
    public function getValidator()
    {
        return new RequestValidator()->Validate(
            ["id" => request()->route('id')],
            [
                "id" => "required|numeric"
            ]
        );
    }

    // Validate post method request 
    public function postValidator()
    {
        return new RequestValidator()->Validate(
            request()->all(),
            [
                "name" => "required|string|max:20|unique:products" ,
                "image_url" => "required|url"  ,
                "description" => "required|string|max:100" ,
                "price" => "required|numeric|max:1000000000" ,
                "products_count" => "required|integer|max:100000000" ,
            ] 
        );
    }

    // validate put method request
    public function putValidator()
    {
        return new RequestValidator()->Validate(
            // merge request credentials to routes id
            array_merge(request()->all() , ["id" => request()->route('id')]) ,
            [
                "id" => "required|numeric|max:1000000" ,
                "name" => "string|max:20|unique:products" ,
                "image_url" => "url"  ,
                "description" => "string|max:100" ,
                "price" => "numeric|max:10000000000" ,
                "products_count" => "integer|min:0" ,
            ] 
        );
    }

    public function deleteValidator()
    {
        return new RequestValidator()->Validate(
            ["id" => request()->route('id')] ,
            [
                "id" => "required|numeric|max:100000"
            ]
        );
    }
}
