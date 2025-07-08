<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

// Routs
Route::get("/" , function(){
    return response()->json([ "message" => "home page" ]);
});

Route::post('/login' , [AuthController::class , "Login"])->middleware([AuthMiddleware::class]);
Route::post('/register' , [AuthController::class , "Register"])->middleware([AuthMiddleware::class]);
Route::post('/logout' , [AuthController::class , "Logout"]);
Route::get('/user' , [AuthController::class , "User"]);