<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/products' ,[\App\Http\Controllers\ProductsController::class ,'uploadProductsView'])->name('products');
Route::post('/products' ,[\App\Http\Controllers\ProductsController::class ,'uploadProducts'])->name('products-upload');
Route::get('/download' ,[\App\Http\Controllers\ProductsController::class ,'downloadProducts'])->name('products-download');

