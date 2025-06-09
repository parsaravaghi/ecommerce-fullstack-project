<?php

use Illuminate\Support\Facades\Route;

// Routs
Route::get("/" , function(){
    return response()->json([ "message" => "home page" ]);
});
