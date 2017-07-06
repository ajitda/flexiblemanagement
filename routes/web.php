<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth', 'admin']], function(){

    //protected routes for employees
    Route::resource('/employees', 'EmployeeController');

    //protected route for reports
    Route::get('/reportsummary', 'ReportController@reportsummary');
    Route::get('/birdreports', 'ReportController@birdreports');
    Route::get('/reports/getallsummary', 'ReportController@getallsummary');
    Route::get('/reports/getbirdreportsummary', 'ReportController@getbirdreportsummary');

    //protected route for summary
    Route::get('/birds', 'BirdsController@index');
    Route::get('/chicks', 'ChicksController@index');
    route::get('/feeds', 'FeedController@index');
});

//unprotected route for reports
Route::get('/getdailyreport', 'ReportController@getdailyreport');
Route::get('/dailyreport', 'ReportController@dailyreport');

Route::get('/home', 'HomeController@index')->name('home');

//route for birds
Route::resource('/suppliers', 'SuppliersController');
Route::resource('/customers', 'CustomersController');
Route::resource('/purchases', 'PurchasesController');
Route::resource('/sales', 'SaleController');
Route::get('/birds/customers/getsales', 'CustomersController@getSaleslist');
Route::get('/birds/sales/getsaleslist', 'SaleController@salesList');
Route::get('/birds/purchases/getpurchaselist', 'PurchasesController@getpurchaselist');

//route for chicks
Route::resource('/chicksuppliers', 'ChickSupplierController');
Route::resource('/chickcustomers', 'ChickCustomerController');
Route::resource('/chickpurchases', 'ChickPurchaseController');
Route::resource('/chicksales', 'ChickSaleController');
Route::get('/chicks/customers/getsales', 'ChickCustomerController@getSaleslist');
Route::get('/chicks/sales/getsaleslist', 'ChickSaleController@salesList');
Route::get('/chicks/purchases/getpurchaselist', 'ChickPurchaseController@getpurchaselist');
Route::get('/feeds/purchases/getpurchaselist', 'ChickPurchaseController@getpurchaselist');


//route for feed
route::resource('/feedsuppliers', 'FeedSupplierController');
route::resource('/feedcustomers', 'FeedCustomerController');
route::resource('/feedpurchases', 'FeedPurchaseController');
route::resource('/feedsales', 'FeedSaleController');
Route::get('/feeds/customers/getsales', 'FeedCustomerController@getSaleslist');
Route::get('/feeds/sales/getsaleslist', 'FeedSaleController@salesList');
Route::get('/feeds/purchases/getpurchaselist', 'FeedPurchaseController@getpurchaselist');

//route for expenses
Route::resource('/expenses', 'ExpenseController');
Route::resource('/expensecategory', 'ExpenseCategoryController');





//factory(App\FeedCustomer::class, 5)->create();
