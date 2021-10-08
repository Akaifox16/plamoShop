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
use App\Http\Controllers\customerServiceController;
use App\Http\Controllers\employeeServiceController;

// #Pure view routimg
Route::get('/', function () { 
    return view('feature');
});
// Route::get('/create-customer-account',function(){
//     return view('createMemberAccount');
// });
// Route::get('/create-customer-order',function(){
//     return view('createCustomerOrder');
// });
// Route::get('/catalog',function(){
//     return view('catalog');
// });

// // #Customer service routing
// Route::get('/get-selaerep/{id}',[customerServiceController::class,
// 'getselaeRepByEmployee']);
// Route::get('/get-totalPrice/{id}',[customerServiceController::class,
// 'getTotalEachOrderByCustomer']);

// // #Employee service routing
// // #address group
// Route::get('/customer-list',[employeeServiceController::class,
// 'getCustomerListView']);
// Route::get('/customer-address/{id}',[employeeServiceController::class,
// 'getAddressesView']);
// Route::get('/add-address/{id}',[employeeServiceController::class,
// 'getAddressView']);
// Route::post('/add-address',[employeeServiceController::class,
// 'createNewAddr']);
// Route::get('/edit-address/{id}/{no}',[employeeServiceController::class,
// 'getEditAddrView']);
// Route::post('/edit-address/{id}/{no}',[employeeServiceController::class,
// 'editAddr']);
// Route::post('/delete-address/{id}/{no}',[employeeServiceController::class,
// 'delAddr']);
// // #order group
// Route::post('/create-customerOrder/{id}',[employeeServiceController::class,
// 'createCustomerOrder']);
// Route::post('/update-customerOrder/{oid}',[employeeServiceController::class,
// 'updateCustomerOrder']);
// // #account mange group
// Route::post('/create-customerAccount/{id}',[employeeServiceController::class,
// 'createCustomerAccount']);
