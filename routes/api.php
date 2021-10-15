<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\employeeServiceController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// routing path {localhost}/api/address/.
Route::prefix('address')->group(function ()
{
    Route::get('/{cid}',[AddressController::class,
    'get']);
    Route::get('/count/{cid}',[AddressController::class,
    'count']);
    Route::get('/edit/{id}',[AddressController::class,
    'getAddress']);
    Route::post('/create',[AddressController::class,
    'create']);
    Route::patch('/edit/{id}',[AddressController::class,
    'edit']);
    Route::delete('/del/{id}',[AddressController::class,
    'del']);    
});

// routing path {localhost}/api/order/.
Route::prefix('order')->group(function ()
{
    Route::post('/create/{id}',[OrderController::class,
    'create']);
    Route::patch('/update/{oid}',[OrderController::class,
    'update']);
});

// routing path {localhost}/api/customer/.
Route::prefix('customer')->group(function ()
{
    Route::post('/create/{id}',[employeeServiceController::class,
    'create']);
});

Route::post('/signup',[loginController::class,
'signup']);
Route::post('/login',[loginController::class,
'login']);

Route::get('/customers',[employeeServiceController::class,
'get']);
Route::get('/customers/{eid}',[employeeServiceController::class,
'getByID']);
