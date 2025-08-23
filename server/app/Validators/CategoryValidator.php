<?php

namespace App\Validators;


class CategoryValidator
{
    public function getValdator()
    {
        return new RequestValidator()->validate(
            request()->query() ,
            [
                "id" => "numeric|max:1000000|" ,
                "search" => "string|max:40"
            ]
        );
    }

    public function postValidator()
    {
        return new RequestValidator()->validate(
            request()->all() ,
            [
                "name" => "required|string|max:30|unique:categories" ,
                "description" => "required|string|max:500" ,
                "image_url" => "url" ,
                "parent_id" => "numeric|nullable|max:10000|exists:categories"
            ]
        );
    }

    public function putValidator()
    {
        return new RequestValidator()->validate(
            array_merge(request()->all() , ["id" => request()->route('id')]) ,
            [
                "id" => "required|numeric|max:100000|exists:categories" ,
                "name" => "string|max:30|unique:categories" ,
                "description" => "string|max:500" ,
                "image_url" => "url" ,
                "parent_id" => "numeric|nullable|max:10000|exists:categories" 
            ]
        );
    }

    public function deleteValidator()
    {
        return new RequestValidator()->validate(
            ["id" => request()->route('id')] ,
            [
                "id" => "required|numeric|max:100000|exists:categories" ,
            ]
        );
    }
}
