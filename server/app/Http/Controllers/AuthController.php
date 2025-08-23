<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Validators\AuthValidator;
use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validate = new AuthValidator()->loginValidator();

        // Show error messages to client if user's data isn't validated
        if(!$validate['status'])
            return response()->json(["error" => $validate['errors']] , 409);

        // send error message if username or password was not correct
        if(!$token = JWTAuth::attempt(["username" => $request->username ,"password" => $request->password , "is_verified" => true] , true))
            return response()->json(["errror" => "Username or password is not correct" ] , 401);
        
        return response()->json([
            "token" => $token ,
            "type_token" => "Bearer" ,
        ]);
    }

    public function register(Request $request)
    {
        $validate = new AuthValidator()->registerValidator();

        if(!$validate['status'])
            return response()->json(["errors" => $validate['errors']] , 409);

        // create user by client's data
        $user = User::create(array_merge(
            $request->only(['username' , 'password' , 'email' , 'role']) , // classify request credentials 
            ["is_verified" => $request->role == 0]  // user is verified when its role is normal user (0 = 'normal user')
        ));
        
        return response()->json([
            "message" => "User created successfully" ,
            "token" => $user->is_verified ? JWTAuth::fromUser($user) : null 
        ]);
    }
}