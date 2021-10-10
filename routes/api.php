<?php

use App\Http\Controllers\employeeServiceController;
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
Route::get('/customer-list',[employeeServiceController::class,
'getCustomerList']);
Route::get('/customer-address/{id}',[employeeServiceController::class,
'getAddresses']);
Route::get('/count-address/{id}',[employeeServiceController::class,
'countAddress']);
Route::post('/add-address',[employeeServiceController::class,
'createNewAddr']);
Route::get('/edit-address/{id}/{no}',[employeeServiceController::class,
'getEditAddr']);
Route::post('/edit-address/{id}/{no}',[employeeServiceController::class,
'editAddr']);
Route::delete('/delete-address/{id}/{no}',[employeeServiceController::class,
'delAddr']);
// #order group
Route::post('/create-customerOrder/{id}',[employeeServiceController::class,
'createCustomerOrder']);
Route::post('/update-customerOrder/{oid}',[employeeServiceController::class,
'updateCustomerOrder']);
// #account mange group
Route::post('/create-customerAccount/{id}',[employeeServiceController::class,
'createCustomerAccount']);
