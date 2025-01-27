<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MogitateController;
use App\Http\Controllers\RegisterController;
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
Route::get('/products/register', function () {
    return view('register');
});

Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/register', [RegisterController::class, 'index']);
Route::post('/products/register', [RegisterController::class, 'store']);