<?php

use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('customer-signin', 'CostumersController@signIn');
    Route::post('customer-signup', 'CostumersController@signUp');
    Route::post('customer-signout', 'CostumersController@signOut');
    Route::post('customer-update/{id}', 'CostumersController@updateProfile');
});

Route::apiResource('/category', 'App\Http\Controllers\Api\CategoryController');
Route::apiResource('/blog', 'App\Http\Controllers\Api\BlogController');
Route::apiResource('/blog-category', 'App\Http\Controllers\Api\BlogCategoryController');
Route::apiResource('/brand', 'App\Http\Controllers\Api\BrandController');
Route::apiResource('/color', 'App\Http\Controllers\Api\ColorController');
Route::apiResource('/attribute', 'App\Http\Controllers\Api\AttributeController');
Route::apiResource('/supplier', 'App\Http\Controllers\Api\SupplierController');
Route::apiResource('/product', 'App\Http\Controllers\Api\ProductController');
Route::apiResource('/sub-category', 'App\Http\Controllers\Api\SubCategoryController');
Route::apiResource('/customer', 'App\Http\Controllers\Api\CustomerController');
Route::apiResource('/baby', 'App\Http\Controllers\Api\BabyController');
Route::apiResource('/employee', 'App\Http\Controllers\Api\EmployeeController');
Route::apiResource('/attribute-value', 'App\Http\Controllers\Api\AttributeValueController');

Route::get('/show-baby/{id}', 'App\Http\Controllers\Api\BabyController@showBaby');
Route::get('/show-sub-category/{id}', 'App\Http\Controllers\Api\SubCategoryController@showSubCategory');

//Salary
Route::Post('/salary/paid/{id}', 'App\Http\Controllers\Api\SalaryController@Paid');
Route::Get('/salary', 'App\Http\Controllers\Api\SalaryController@AllSalary');
Route::Get('/salary/view/{id}', 'App\Http\Controllers\Api\SalaryController@ViewSalary');
Route::Get('/edit/salary/{id}', 'App\Http\Controllers\Api\SalaryController@EditSalary');
Route::Post('/salary/update/{id}', 'App\Http\Controllers\Api\SalaryController@SalaryUpdate');

// Order Route
// Route::Get('/orders', 'App\Http\Controllers\Api\OrderController@TodayOrder');
// Route::Get('/order/details/{id}', 'App\Http\Controllers\Api\OrderController@OrderDetails');
// Route::Get('/order/order-details/{id}', 'App\Http\Controllers\Api\OrderController@OrderDetailsAll');
// Route::Post('/search/order', 'App\Http\Controllers\Api\PosController@SearchOrderDate');

Route::Post('/stock/update/{id}', 'App\Http\Controllers\Api\ProductController@StockUpdate');

//Cart
Route::apiResource('/cart', 'App\Http\Controllers\Api\CartController');

//Wishlist
Route::apiResource('/wishlist', 'App\Http\Controllers\Api\WishlistController');

//Order
Route::apiResource('/order', 'App\Http\Controllers\Api\OrderController');

//Review
Route::apiResource('/review', 'App\Http\Controllers\Api\ReviewController');

//Product Search
Route::Post('/product/search', 'App\Http\Controllers\Api\ProductController@ProductSearch');

//Address
Route::apiResource('/address', 'App\Http\Controllers\Api\AddressController');
Route::Get('/selected/address/{id}', 'App\Http\Controllers\Api\AddressController@SelectedAddress');
Route::Patch('/select/address/{id}', 'App\Http\Controllers\Api\AddressController@SelectAddress');

//Select Baby
Route::Get('/selected/baby/{id}', 'App\Http\Controllers\Api\BabyController@SelectedBaby');
Route::Patch('/select/baby/{id}', 'App\Http\Controllers\Api\BabyController@SelectBaby');

//Product By Sub Category
Route::Get('/product/sub-category/{id}', 'App\Http\Controllers\Api\ProductController@ShowByCategory');

//Attribute By attribute id and name
Route::Get('/attribute/attribute-value/{id}', 'App\Http\Controllers\Api\AttributeValueController@showAttribute');
Route::Get('/attribute-value/by-name/{name}', 'App\Http\Controllers\Api\AttributeValueController@showAttributeByName');

// Count Today Customers , Sales and Orders
Route::Get('/today/customer', 'App\Http\Controllers\Api\CustomerController@TodayCustomer');
Route::Get('/total/sale', 'App\Http\Controllers\Api\OrderController@TotalSale');
Route::Get('/today/order', 'App\Http\Controllers\Api\OrderController@TodayOrder');

Route::Get('/order/by-id/{id}', 'App\Http\Controllers\Api\OrderController@OrderById');
Route::Get('/refund/order', 'App\Http\Controllers\Api\OrderController@Refund');
