<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// // // // // // // // // // // // // // // PRIVITE ROUTES // // // // // // // // // // // // // // // // // // // // //
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//categories
Route::middleware('auth:sanctum')->post('/logout',[AuthenticatedSessionController::class,'destroy']);
Route::middleware('auth:sanctum')->post('/categories/create',[CategoryController::class,'store']);
Route::middleware('auth:sanctum')->get('/categories',[CategoryController::class,'index']);
Route::middleware('auth:sanctum')->get('/categories/{id}',[CategoryController::class,'show']);
Route::middleware('auth:sanctum')->delete('/categories/{id}',[CategoryController::class,'destroy']);
Route::middleware('auth:sanctum')->put('/categories/{id}',[CategoryController::class,'edit']);

//Posts
Route::post('/posts/create',[PostsController::class,'store']);


// // // // // // // // // // // // // // // PUBLIC ROUTES // // // // // // // // // // // // // // // // // // // // //
Route::post('/register',[RegisteredUserController::class,'store']);
Route::post('/login',[AuthenticatedSessionController::class,'store']);
