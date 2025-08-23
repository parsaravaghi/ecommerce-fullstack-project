<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Validators\ProductValidator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function search(Request $request)
    {
        $search = $request->query('search');

        // search products by like query
        $products = Product::where(["is_verified" => true]) // product must be validated by admin
            ->where(function($query) use ($search){
                $query->where("name" , 'like' , "%{$search}%")
                    ->orWhere("description" , 'like' , "%{$search}%");
            })
            ->get();

        return response()->json(["products" => $products]);
    }

    public function get(Request $request)
    {
        $validator = new ProductValidator()->getValidator();

        if($validator['status']) 
            return response()->json($validator['errors'] , 409);
        
        // find product by id
        $product = Product::where(["id" => $request->route('id')])
            ->where(["is_verified" => true])
            ->first();
        
        return response()->json($product ? ["product" => $product] : ["message" => "Product not found"] , $product ? 200 : 404);
        
    }

    public function post(Request $request)
    {
        $validator = new ProductValidator()->postValidator();

        // return validator error
        if(!$validator['status']) 
            return response()->json($validator['errors'] , 406);
        
        // get user request credentials (the owner added from middleware)
        $credentials = $request->only(["name" , "description" , "price" , "products_count" , "image_url" , "owner" , "is_verified" ]);
        
        // record new product to database
        Product::create($credentials);
        
        // return success message after recording 
        return response()->json(["message" => "Product added successfully"] , 201);
        
    }

    public function put(Request $request)
    {
        $validator = new ProductValidator()->putValidator();
        
        // return error message if validation failed
        if(!$validator['status']) 
            return response()->json($validator['errors'] , 409);
        
        // get user request credentials
        $credentials = $request->only(["name" , "description" , "price" , "products_count" , "image_url"]);
        
        $id = $request->route('id');

        // the condition
        $updatedCount = $request->input('role') == 1  // get role added from middleware (condition)

        // the condition that the user role is seller (1)
        ?Product::where(["id" => $id])
            ->where(["owner" => $request->input('owner')]) // only the owner can update his own product
            ->update($credentials)

        // the condtion that user role is admin (2 ,3)
        :Product::where(["id" => $id])->update($credentials); // admin : can update any

        // return success message 
        return response()->json(["message" => "Updated $updatedCount product(s)"]);
        
    }

    public function delete(Request $request)
    {
        $validator = new ProductValidator()->deleteValidator();

        // return error message if validation failed
        if(!$validator['status'])
            return response()->json($validator['errors'] , 409);
        
        // Get user id by request query string
        $id = $request->route('id');

        $deletedCount = $request->input('role') == 1  // get role added from middleware (condition)

        // the condition that the user role is seller (1)
        ?Product::where(["id" => $id])
            ->where(["owner" => $request->input('owner')]) // only the owner can delete his prodcut
            ->delete()

        // the condtion that user role is admin (2)
        :Product::where(["id" => $id])->delete(); // admin : can delete any

        return response()->json(["message" => "$deletedCount product(s) deleted"] , 202);
    }
}