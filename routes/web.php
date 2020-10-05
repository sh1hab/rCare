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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('login');
});

Route::get('logout', 'Auth\LoginController@logout');

Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    // Route::get('/', function ()    {
    //     // Uses Auth Middleware
    // });

    // Route::get('user/profile', function () {
    //     // Uses Auth Middleware
    // });

    // ----------------------customer claim---------------------

    Route::get('/customer/claim', 'CustomerController@claim')->name('customer-claim');
    Route::get('/customer/claim_list', 'CustomerController@claim_list')->name('claim-list');
    Route::get('/customer/claim_data', 'CustomerController@claim_data')->name('claim-data');

    Route::post('/customer/add_claim', 'CustomerController@add_claim');
    Route::post('/customer/check_customer', 'CustomerController@check_customer');



	// -----------------------Setup -----------------------------

    Route::get('/dashboard', 'SetupController@dashboard')->name('dashboard');

	Route::get('/setup/bank', 'SetupController@bank')->name('add-bank');
	Route::post('/setup/add_bank', 'SetupController@add_bank');

	Route::get('/setup/location', 'SetupController@location')->name('add-location');
	Route::post('/setup/add_location', 'SetupController@add_location');

	Route::get('/setup/category', 'SetupController@category')->name('category');
	Route::post('/setup/add_category', 'SetupController@add_category');
	Route::post('/setup/check_category_code', 'SetupController@check_category_code');

	Route::get('/setup/brand', 'SetupController@brand')->name('add-brand');
	Route::post('/setup/add_brand', 'SetupController@add_brand');
	Route::post('/setup/check_brand_code', 'SetupController@check_brand_code');

	Route::get('/setup/card', 'SetupController@card')->name('add-card');
	Route::post('/setup/add_card', 'SetupController@add_card');


	Route::get('/setup/asset', 'SetupController@asset')->name('add-asset');
	Route::post('/setup/asset_type', 'SetupController@asset_type');
	Route::post('/setup/asset_head', 'SetupController@asset_head');

	Route::get('/setup/warranty', 'SetupController@warranty')->name('add-warranty');
	Route::post('/setup/add_warranty', 'SetupController@add_warranty');


	Route::get('/setup/parts_accessories', 'SetupController@parts_accessories')->name('add-parts-accessories');
	Route::post('/setup/add_parts_accessoris', 'SetupController@add_parts_accessoris');

	Route::get('/setup/employee_role', 'SetupController@employee_role')->name('add-employee-role');
	Route::post('/setup/add_role', 'SetupController@add_role');
	Route::post('/setup/edit_role', 'SetupController@edit_role');


	Route::get('/purchase/approve_data', 'PurchaseController@approve_data')->name('approve-data');

	Route::get('/setup/supplier', 'SetupController@supplier')->name('add-supplier');
	Route::post('/setup/add_supplier', 'SetupController@add_supplier');

	Route::get('/setup/permission', 'SetupController@permission')->name('add-permission');

	Route::get('/setup/bank_account', 'SetupController@bank_account')->name('add-bank-account');
	Route::post('/setup/add_bank_account', 'SetupController@add_bank_account');

	Route::get('/setup/service', 'SetupController@service')->name('add-service');
	Route::post('/setup/add_service', 'SetupController@add_service');


	Route::get('/setup/users', 'SetupController@users')->name('users');
	Route::get('/setup/add_user', 'SetupController@add_user')->name('add-user');
	Route::post('/setup/post_add_user', 'SetupController@post_add_user');
	Route::get('/setup/edit_user/{id}', 'SetupController@edit_user')->name('edit-user');


	// ----------------------- purchase ---------------

	Route::get('/purchase/request', 'PurchaseController@request')->name('create-request');
	Route::post('/purchase/post_request', 'PurchaseController@post_request');


	Route::any('/purchase/request_list', 'PurchaseController@request_list')->name('request-list');
	Route::get('/purchase/approved_list', 'PurchaseController@approved_list')->name('approved-list');
	Route::get('/purchase/request_status/{id}/{status}', 'PurchaseController@request_status')->name('request-status');

	Route::get('/purchase/challan', 'PurchaseController@challan')->name('draft-challan');
	Route::post('/purchase/add_note', 'PurchaseController@add_note');

	Route::get('datatables.data', 'PurchaseController@anyData')->name('datatables.data');

});

