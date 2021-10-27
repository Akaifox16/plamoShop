<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\catalogController;
use App\Http\Controllers\customerServiceController;
use App\Http\Controllers\employeeServiceController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\stockController;
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
    Route::get('/update/{id}',[AddressController::class,
    'getAddress']);
    Route::post('/create',[AddressController::class,
    'create']);
    Route::patch('/update/{id}',[AddressController::class,
    'edit']);
    Route::delete('/del/{id}',[AddressController::class,
    'del']);    
});

// routing path {localhost}/api/order/.
Route::prefix('order')->group(function ()
{
    Route::get('/{cid}',[OrderController::class,
    'get']);
    Route::get('/get-details/{id}',[OrderController::class,
    'getDetails']);
    Route::post('/create/{id}',[OrderController::class,
    'create']);
    Route::patch('/update/{oid}',[OrderController::class,
    'update']);
    Route::patch('/update-payment',[OrderController::class,
    'updatePayment']);
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
Route::get('/employees',[employeeServiceController::class,
'getEmployee']);
Route::get('/employee/{id}',[employeeServiceController::class,
'getEmployeeByID']);
Route::get('/customers/{eid}',[employeeServiceController::class,
'getByID']);


Route::get('/catalog',[catalogController::class,'filter']);

Route::post('/payment',[paymentController::class,'insert']);

Route::post('/promote',[employeeServiceController::class,'promote']);

Route::patch('/points',[customerServiceController::class,'points']);

//stock access api

Route::get('/stock',[stockController::class,'get']);

Route::post('/stock/create',[stockController::class,'create']);

Route::get('/getstock',[stockController::class,
'getstock']);

Route::prefix('stock')->group(function (){
    Route::get('/count/{cid}',[stockController::class,
    'count']);
    
    Route::get('/{id}',[stockController::class,
    'getstockByID']);
});

Route::get('/preorder',[PreOrderController::class,'getPreOrder']);

Route::get('/product-line/{type}',[catalogController::class,
'getImg']);
