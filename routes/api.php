<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' =>'auth'] , function (){
    Route::post('register' , [\App\Http\Controllers\AuthController::class , 'Register']);
    Route::post('login' , [\App\Http\Controllers\AuthController::class , 'Login']);
});



Route::get('products' , [\App\Http\Controllers\ProductsController::class , 'getAllProducts']);


Route::group(['prefix' =>'cart' , 'middleware' => 'jwtAuth'] , function (){
    Route::post('add' , [\App\Http\Controllers\CartController::class , 'addToCart']);
    Route::post('delete' , [\App\Http\Controllers\CartController::class , 'deleteFromCart']);
    Route::post('update' , [\App\Http\Controllers\CartController::class , 'updateCart']);
    Route::get('show ' , [\App\Http\Controllers\CartController::class , 'userCart']);
});
