<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;

// tesing
Route::get("/", function () {
    return response()->json(["message" => "api works"]);
});


// login and register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);





Route::get("/", function () {
    return response()->json(["message" => "api works"]);
});


// routes
Route::middleware('auth:sanctum')->group(function () {

    // list users
    Route::get('/users', function () {
        return response()->json(["useres" => User::all()]);
    });


    // user stuff
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // countries resource
    Route::apiResource('countries', CountryController::class);
});
