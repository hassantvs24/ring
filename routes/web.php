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
Route::group(['middleware' => 'auth'], function () {

    Route::resource('/',  'Dashboard\DashboardController');

    Route::resource('/user/all',  'User\UserController');
    Route::resource('/user/role',  'User\RolesController');

    Route::get('/purchase/list',  'Purchase\PurchaseListController@index')->name('purchase-list.index');
    Route::get('/purchase/pending',  'Purchase\PurchaseListController@pending')->name('purchase.pending');
    Route::get('/purchase/ordered',  'Purchase\PurchaseListController@ordered')->name('purchase.ordered');
    Route::resource('/purchase',  'Purchase\PurchaseController')->except(['create']);

    Route::get('/sales/list',  'Sales\SalesListController@index')->name('sales-list.index');
    Route::get('/sales/quotation',  'Sales\SalesListController@quotation')->name('sales.quotation');
    Route::get('/sales/draft',  'Sales\SalesListController@draft')->name('sales.draft');
    Route::resource('/sales',  'Sales\SalesController')->except(['create']);


    Route::delete('/customer/payment/{id}',  'Customer\CustomerController@delete_due_payment')->name('customer.del-payment');
    Route::put('/customer/payment/{id}/{customer}',  'Customer\CustomerController@edit_due_payment')->name('customer.edit-payment');
    Route::put('/customer/payment/{id}',  'Customer\CustomerController@due_payment')->name('customer.payment');


    Route::get('/customer/transaction/{id}',  'Customer\CustomerController@transaction')->name('customer.transaction');
    Route::resource('/customer/list',  'Customer\CustomerController',['names' => 'customer'])->except(['create', 'show', 'edit']);
    Route::resource('/customer/category',  'Customer\CustomerCategoryController',['names' => 'customer-category'])->except(['create', 'show', 'edit']);

    Route::get('/stock/transaction/{id}',  'Stock\ProductController@transaction')->name('stock.transaction');
    Route::resource('/stock/products',  'Stock\ProductController')->except(['create', 'show', 'edit']);
    Route::resource('/stock/category',  'Stock\ProductCategoryController',['names' => 'product-category'])->except(['create', 'show', 'edit']);
    Route::resource('/stock/units',  'Stock\UnitController')->except(['create', 'show', 'edit']);
    Route::resource('/stock/brand',  'Stock\BrandController')->except(['create', 'show', 'edit']);
    Route::resource('/stock/company',  'Stock\CompanyController')->except(['create', 'show', 'edit']);

    Route::get('/stock/adjustment/item/{id}',  'Stock\AdjustmentController@get_items')->name('get_item');//Adjustment Item API
    Route::resource('/stock/adjustment',  'Stock\AdjustmentController')->except(['create', 'show', 'edit']);

    Route::delete('/supplier/payment/{id}',  'Supplier\SupplierController@delete_due_payment')->name('supplier.del-payment');
    Route::put('/supplier/payment/{id}/{supplier}',  'Supplier\SupplierController@edit_due_payment')->name('supplier.edit-payment');
    Route::put('/supplier/payment/{id}',  'Supplier\SupplierController@due_payment')->name('supplier.payment');

    Route::get('/supplier/transaction/{id}',  'Supplier\SupplierController@transaction')->name('supplier.transaction');
    Route::resource('/supplier/list',  'Supplier\SupplierController',['names' => 'supplier'])->except(['create', 'show', 'edit']);
    Route::resource('/supplier/category',  'Supplier\SupplierCategoryController',['names' => 'supplier-category'])->except(['create', 'show', 'edit']);

    Route::resource('/expenses',  'Expense\ExpenseController')->except(['create', 'show', 'edit']);
    Route::resource('/expenses/category',  'Expense\ExpenseCategoryController',['names' => 'expense-category'])->except(['create', 'show', 'edit']);

    Route::resource('/accounts/list',  'Accounts\AccountsController',['names' => 'accounts'])->except(['create', 'show', 'edit']);

    Route::resource('/settings/business',  'Settings\BusinessController')->only(['show', 'update']);
    Route::resource('/settings/warehouse',  'Settings\WareHouseController')->except(['create', 'show', 'edit']);
    Route::resource('/settings/discount',  'Settings\DiscountController')->except(['create', 'show', 'edit']);
    Route::resource('/settings/shipment',  'Settings\ShipmentController')->except(['create', 'show', 'edit']);
    Route::resource('/settings/vat-tax',  'Settings\VatTaxController')->except(['create', 'show', 'edit']);
    Route::resource('/settings/zone',  'Settings\ZoneController')->except(['create', 'show', 'edit']);

    Route::resource('/user/roles',  'User\RolesController')->except(['create', 'show', 'edit']);
    Route::resource('/user',  'User\UserController')->except(['create', 'show', 'edit']);

});


Route::get('/welcome', function (){
    return view('welcome');
});

//==================== Backup Database =======================
Route::get('/catch', 'MainController@catches')->name('catches');
//==================== /Backup Database =======================

//==================== Backup Database =======================
Route::get('/backup', 'MainController@backup')->name('backup');
//==================== /Backup Database =======================

//==================== Toggle Sidebar =======================
Route::get('/savestate', 'MainController@saveState')->name('sidebar');
//Route::get('key', 'MainController@key');
//==================== /Toggle Sidebar =======================

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
