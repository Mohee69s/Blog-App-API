<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store']);
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/posts', [PostsController::class, 'index'])->name('posts');
Route::post('/login',[AuthController::class,'store']);
Route::post('/posts/create',[PostsController::class,'create']);
