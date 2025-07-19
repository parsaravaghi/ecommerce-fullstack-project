<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validator\ProductValidator;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function Search(Request $request)
    {
        // get user data from query string
        $search = $request->query('search');

        // search products by like query
        $products = Product::where("title" , 'like' , "%$search%")
        ->orWhere("description" , 'like' , "%$search%")->get();

        return response()->json(["products" => $products]);
    }
    public function Get(Request $request)
    {
        $validator = new ProductValidator()->GetValidator();

        if($validator['status'])
        {
            // find product by id
            $product = Product::where(["id" => $request->route('id')])->first();

            return response()->json($product ? ["product" => $product] : ["message" => "Product not found"] , $product ? 200 : 404);
        }
        else
        {
            // return error message if validation failed
            return response()->json($validator['errors'] , 409);
        }
    }

    public function Post(Request $request)
    {
        // validate user request
        $validator = new ProductValidator()->PostValidator();

        // check the validator status
        if($validator['status'])
        {
            try 
            {
                // recording new product to database
                $product = Product::create($request->only(["title" , "imageUrl" , "description" , "price" , "products_count"]));
            } 
            catch (QueryException $e) 
            {
                // To make the query defensive we would use try catch
                return response()->json(["error" => "somthing went wrong"] , 500);
            }

            // return success message after recording 
            return response()->json(["message" => "Product added successfully"] , 201);
        }
        else
        {
            // return validator error
            return response()->json($validator['errors'] , 406);
        }
    }

    public function Put(Request $request)
    {
        // validate user request
        $validator = new ProductValidator()->PutValidator();
        
        if($validator['status'])
        {
            // get user request credentials
            $credentials = $request->only(["title" , "description" , "price" , "products_count" , "imageUrl"]);
            
            try 
            {
                // use asynchronous condition variable to run no quey if user credentials is null
                $updated = $credentials ? Product::where(["id" => $request->query('id')])->update($credentials) : 0;
                return response()->json(["status" => "Updated $updated data"]);
            } 
            catch (QueryException $e) {
                // To make the query defensive we would use try catch
                return response()->json(["error" => "somthing went wrong"] , 500);
            }
        }
        else
        {
            // return error message
            return response()->json($validator['errors'] , 409);
        }
    }

    public function Delete(Request $request)
    {   
        $validator = new ProductValidator()->DeleteValidator();

        if($validator['status'])
        {
            // Get user id by request query string
            $id = $request->query('id');

            $deletedProduct = Product::where(["id" => $id])->delete();

            return response()->json(["message"=>"$deletedProduct products deleted"] , 202);
        }
        else
        {
            return response()->json($validator['errors'] , 409);
        }
    }

}