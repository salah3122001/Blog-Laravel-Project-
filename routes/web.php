<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/',[PostController::class,'main'])->name('main');

Route::get('/show',[PostController::class,'show'])->name('show_post');


Route::middleware(['auth','verified'])->group(function(){
    
Route::get('/create',[PostController::class,'create'])->name('create_post');
Route::post('/store',[PostController::class,'store'])->name('store_post');

Route::get('/edit/{id}',[PostController::class,'edit'])->name('edit_post');
Route::post('/update/{id}',[PostController::class,'update'])->name('update_post');
Route::post('/destroy/{id}',[PostController::class,'destroy'])->name('destroy_post');


Route::post('/store/{id}',[CommentController::class,'store'])->name('store_comment');


Route::delete('/destroy/{id}',[CommentController::class,'destroy'])->name('destroy_comment');



});
