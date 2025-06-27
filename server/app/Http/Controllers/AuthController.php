<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validator\AuthValidator;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function Login(Request $request)
    {
        // Validate user's data
        $validate = new AuthValidator($request);
        $validate = $validate->ValidateLogin();

        // Login user if user's data is validated
        if($validate['status'])
        {
            // select user data by clients information
            $user = User::where([
                "username" => $request->username 
            ])->first();

            // set user not found message
            if(!$user)
            {
                return response()->json(["error" => "user not found"] , 401);
            }

            // Match user's password and the password that we selected 
            if($user && Hash::check($request->password , $user->password))
            {
                // Login user
                Auth::login($user,true);
                return response()->json(["message" => "you logged in successfully"] , 202);
            }
            else
            {
                // The password is not correct so we send error message to client
                return response()->json(["error" => "your password is not correct"] , 406);
            }
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
        $validate = new AuthValidator($request);
        $validate = $validate->ValidateRegister();

        if($validate['status'])
        {
            // create user by client's data
            $user = User::create($request->only(['username' , 'password' , 'email']))->first();

            // login client
            Auth::login($user);

            return response()->json(["message" => "user created successfully"] , 202);
        }
        else
        {
            return response()->json(["errors" => $validate['errors']] , 409);
        }
    }
}
