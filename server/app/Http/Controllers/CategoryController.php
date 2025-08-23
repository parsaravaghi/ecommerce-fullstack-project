<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Validators\CategoryValidator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get(Request $request)
    {
        $validate = new CategoryValidator()->getValdator();

        // Return error message if validation fails
        if(!$validate['status'])
            return response()->json($validate['errors']);

        // Filter category records with client query string 
        $categories = Category::where(["id" => $request->query('id')])
            ->orWhere("name" , "like" , "%{$request->query('search')}%")
            ->get();

        return response()->json($categories);
    }

    public function post(Request $request)
    {
        $validate = new CategoryValidator()->postValidator();

        // Return error message if validation fails
        if(!$validate['status'])
            return response()->json($validate['errors']);

        // Filter user credentials
        $credentials = $request->only(["name" , "description" , "image_url" , "parent_id"]);

        // Recode new category data
        Category::create($credentials);

        return response()->json(["message" => "Category added successfully"]);
    }

    public function put(Request $request)
    {
        $validator = new CategoryValidator()->putValidator();

        // return error message if validation fails
        if(!$validator['status'])
            return response()->json($validator['errors'] , 409);

        // Filter user credentials
        $credentials = $request->only(["name" , "description" , "image_url" , "parent_id"]);
        $id = $request->route('id');

        // update category from requested id and user admin credentials
        $updatedCategory = Category::where(["id" => $id])
            ->update($credentials);

        return response()->json(["message" => "$updatedCategory catergory(s) updated"] , 201);
    }

    public function delete(Request $request)
    {
        $validator = new CategoryValidator()->deleteValidator();

        // return error message if validation fails
        if(!$validator['status'])
            return response()->json($validator['errors'] , 409);

        $id = $request->route('id');

        // update category from requested id and user admin credentials
        $updatedCategory = Category::where(["id" => $id])->delete();

        return response()->json(["message" => "$updatedCategory catergory(s) deleted"] , 201);
    }
    
}