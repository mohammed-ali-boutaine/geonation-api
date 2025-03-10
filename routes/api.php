<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;

// tesing
Route::get("/",function(){
    return response()->json(["message"=>"api works"]);
});


// login and register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users',function (){
    return response()->json(["useres"=>User::all()]);
});

// routes
Route::middleware('auth:sanctum')->group(function () {

    // user stuff
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });


});



