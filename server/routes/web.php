<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

// Routs
Route::get("/" , function(){
    return response()->json([ "message" => "home page" ]);
});

// Auth routes
Route::post('/login' , [AuthController::class , "Login"])->middleware([AuthMiddleware::class]);
Route::post('/register' , [AuthController::class , "Register"])->middleware([AuthMiddleware::class]);
Route::post('/logout' , [AuthController::class , "Logout"]);
Route::get('/user' , [AuthController::class , "User"]);

// Product routes
Route::get("/product" , [ProductController::class , "Search"]);
Route::get("/product/{id}" , [ProductController::class , "Get"]);
Route::post("/product" , [ProductController::class , "Post"]);
Route::put("/product" , [ProductController::class , "Put"]);
Route::delete("/product" , [ProductController::class , "Delete"]);