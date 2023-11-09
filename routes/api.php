<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\catalogController;
use App\Http\Controllers\customerServiceController;
use App\Http\Controllers\employeeServiceController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ProductController;
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

/*
|=================================
| Authentication
|================================
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signup',[loginController::class,
'signup']);
Route::post('/login',[loginController::class,
'login']);

/*
|=================================
| Address
|================================
*/
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

/*
|=================================
| Order
|================================
*/
Route::prefix('order')->group(function ()
{
    Route::get('/{cid}',[OrderController::class,
    'get']);
    Route::get('/get-details/{id}',[OrderController::class,
    'getDetails']);
    Route::post('/create/{id}',[OrderController::class,
    'create']);
    Route::post('/create-details',[OrderController::class,
    'createDetails']);
    Route::patch('/update/{oid}',[OrderController::class,
    'update']);
    Route::patch('/update-payment',[OrderController::class,
    'updatePayment']);
});
Route::get('/get-last-order',[OrderController::class,
'getLast']);
Route::post('/order-address/{oid}',[OrderController::class,
'createOrderAddress']);

/*
|=================================
| Customer
|================================
*/
Route::prefix('customer')->group(function ()
{ Route::post('/create/{id}',[employeeServiceController::class,
    'create']);
});
Route::prefix('customers')->(function ()
{
    Route::get('/',[employeeServiceController::class,
    'get']);
    Route::get('/{eid}',[employeeServiceController::class,
    'getByID']);
})


/*
|=================================
| Employee
|================================
*/
Route::get('/employees',[employeeServiceController::class,
'getEmployee']);
Route::prefix('employee')->group(function ()
{
    Route::get('/{id}',[employeeServiceController::class,
    'getEmployeeByID']);
})


/*
|=================================
| Catalog
|================================
*/
Route::prefix('catalog')->group(function ()
{
    Route::get('/',[catalogController::class,'filter']);
    Route::get('/noquantity',[catalogController::class,'getnoQty']);
})

/*
|=================================
| Payment
|================================
*/
Route::prefix('payment')->group(function ()
{
    Route::post('/',[paymentController::class,'insert']);
})

/*
|=================================
| Promote
|================================
*/
Route::prefix('promote')->group(function ()
{
    Route::post('/',[employeeServiceController::class,'promote']);
})

/*
|=================================
| Product
|================================
*/
Route::prefix('product',function (){
    Route::patch('/update/{id}',[ProductController::class,'edit']);
    Route::delete('/del/{id}',[ProductController::class,'del']);
    Route::get('/{id}',[ProductController::class,'getproductByID']);
    Route::post('/create',[ProductController::class,'create']);
    Route::patch('/updateList',[ProductController::class,
    'editList']);
});
Route::get('/product-line/{type}',[catalogController::class,
'getImg']);

/*
|=================================
| Point
|================================
*/
Route::prefix('points')->group(function ()
{
    Route::patch('/',[customerServiceController::class,'points']);
})

/*
|=================================
| Preorder
|================================
*/
Route::prefix('preorder')->group(function ()
{
    Route::get('/',[PreOrderController::class,'getPreOrder']);
    Route::post('/create/{id}',[PreOrderController::class,'create']);
})
Route::get('/get-last-preorder',[PreOrderController::class,'getLast']);

/*
|=================================
| Stocks
|================================
*/
Route::prefix('stock')->group(function (){
    Route::get('/',[stockController::class,'get']);
    Route::get('/count/{cid}',[stockController::class,
    'count']);
    Route::post('/create',[stockController::class,'create']);
    Route::get('/{id}',[stockController::class,
    'getstockByID']);
});
Route::get('/getstock',[stockController::class,
'getstock']);

