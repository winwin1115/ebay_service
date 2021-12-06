<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup', [UserController::class, 'signup']);
Route::post('login', [UserController::class, 'login']);
Route::post('getsetting', [CurrencyController::class, 'getsetting']);
Route::post('setCurrency', [CurrencyController::class, 'setcurrency']);
Route::post('setProfit', [CurrencyController::class, 'setprofit']);
Route::post('autoCalc', [CurrencyController::class, 'autocalc']);
Route::post('getBusinessPolicy', [ProductController::class, 'getbusinesspolicy']);
Route::post('addItem', [ProductController::class, 'additem']);
Route::post('getProductlist', [ProductController::class, 'getproduct']);
Route::post('updateProduct', [ProductController::class, 'updateproduct']);
Route::post('checkProduct', [ProductController::class, 'checkproduct']);
Route::post('setToken', [UserController::class, 'settoken']);