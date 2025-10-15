<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;



Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){

    Route::post('/posts',[PostController::class,'store']);
    Route::get('/posts',[PostController::class,'index']);
    Route::get('/posts/{id}',[PostController::class,'show']);
    Route::put('/posts/{id}',[PostController::class,'update']);
    Route::delete('/posts/{id}',[PostController::class,'destroy']);

    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/logoutall',[AuthController::class,'logoutall']);
});
