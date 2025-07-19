<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validator\AuthValidator;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function Login(Request $request)
    {
        // Validate user's data
        $validate = new AuthValidator()->ValidateLogin($request);

        // Login user if user's data is validated
        if($validate['status'])
        {
            // set error message if username or password was not correct
            if(!$token = JWTAuth::attempt(["username" => $request->username ,"password" => $request->password] , true))
            {
                return response()->json(["errror" => "Username or password is not correct" ] , 401);
            }
            return response()->json([
                "token" => $token ,
                "type_token" => "Bearer" ,
            ]);
        }
        else
        {
            // Show error messages to client 
            return response()->json(["error" => $validate['errors']] , 409);
        }
    }

    public function Logout(Request $request)
    {
        // logout user
        Auth::logout();
        return response()->json(["message" => "you logged out successfully"] , 202);
    }

    public function Register(Request $request)
    {
        // validate request body
        $validate = new AuthValidator()->ValidateRegister($request);

        if($validate['status'])
        {
            // create user by client's data
            $user = User::create($request->only(['username' , 'password' , 'email']));
            
            // return user jwt to client
            $token = JWTAuth::fromUser($user);

            return response()->json([
                "message" => "User created successfully" ,
                "token" => $token
            ]);
        }
        else
        {
            return response()->json(["errors" => $validate['errors']] , 409);
        }
    }
    public function User(Request $request)
    {
        // Get user info
        $user = auth('api')->user();

        return response()->json($user);
    }
}