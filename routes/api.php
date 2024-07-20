<?php

use App\Http\Controllers\Api\customerController;
use App\Http\Controllers\Api\productController;
use App\Http\Controllers\Api\saleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('customer', customerController::class);
Route::apiResource('product', productController::class);
Route::apiResource('sale', saleController::class);
