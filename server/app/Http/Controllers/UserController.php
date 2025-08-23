<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function get(Request $request)
    {
        // Get user info
        $user = auth('api')->user();

        return response()->json($user);
    }
}
