<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\employeeServiceController;
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

Route::get('/customer-list',[employeeServiceController::class,
'getCustomerList']);
Route::get('/create-customer-account',function(){
    return view('createMemberAccount');
});
Route::get('/create-customer-order',function(){
    return view('createCustomerOrder');
});

// #Employee service routing
// #address group
Route::get('/address/{id}',[AddressController::class,
'get']);
Route::get('/count/{id}',[AddressController::class,
'count']);
Route::post('/create/address',[AddressController::class,
'create']);
Route::get('/edit/address/{id}/{no}',[AddressController::class,
'getAddressNo']);
Route::post('/edit/address/{id}/{no}',[AddressController::class,
'edit']);
Route::delete('/del/address/{id}/{no}',[AddressController::class,
'del']);
// #order group
Route::post('/create/order/{id}',[OrderController::class,
'create']);
Route::put('/update/order/{oid}',[OrderController::class,
'update']);
// #account mange group
Route::get('/customers',[employeeServiceController::class,
'get']);
Route::post('/create/customer/{id}',[employeeServiceController::class,
'create']);
