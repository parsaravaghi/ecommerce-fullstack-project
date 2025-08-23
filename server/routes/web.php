<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Permissions\AdminGateMiddleware;
use App\Http\Middleware\Permissions\SellerGateMiddleware;



// Routs
Route::get("/" , function(){
    return response()->json([ "message" => "home page" ]);
});

// Auth routes
Route::post('/login' , [AuthController::class , "login"]);
Route::post('/register' , [AuthController::class , "register"]);
Route::post('/logout' , [AuthController::class , "logout"]);

// User routes
Route::get('/user' , [UserController::class , "get"]);

// Product routes
Route::get("/product" , [ProductController::class , "search"]);
Route::get("/product/{id}" , [ProductController::class , "get"]);
Route::post("/product" , [ProductController::class , "post"])->middleware([SellerGateMiddleware::class]);
Route::put("/product/{id}" , [ProductController::class , "put"])->middleware([SellerGateMiddleware::class]);
Route::delete("/product/{id}" , [ProductController::class , "delete"])->middleware([SellerGateMiddleware::class]);

// Category routes
Route::get('/category' , [CategoryController::class , "get"])->middleware([AdminGateMiddleware::class]);
Route::post('/category' , [CategoryController::class , "post"])->middleware([AdminGateMiddleware::class]);
Route::put('/category/{id}' , [CategoryController::class , "put"])->middleware([AdminGateMiddleware::class]);
Route::delete('/category/{id}' , [CategoryController::class , "delete"])->middleware([AdminGateMiddleware::class]);