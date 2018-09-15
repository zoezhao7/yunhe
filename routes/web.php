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

Route::resource('stores', 'StoresController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::namespace('Admin')->middleware(['clean.form'])->group(function () {

    // Auth
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'LoginController@login')->name('admin.login.post');

    Route::middleware(['auth.admin'])->group(function () {
        Route::post('admin/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('admin/welcome', 'WelcomeController@index')->name('admin.welcome');
    });

    Route::middleware(['auth.admin', 'admin.permission'])->group(function () {

        // 权限
        Route::resource('admin/nodes', 'NodesController', ['as' => 'admin']);
        Route::resource('admin/roles', 'RolesController', ['as' => 'admin']);
        Route::resource('admin/admins', 'AdminsController', ['as' => 'admin']);

        // 产品
        Route::resource('admin/categories', 'CategoriesController', ['as' => 'admin']);
        Route::resource('admin/products', 'ProductsController', ['as' => 'admin']);
        Route::get('admin/products/{product}/specs', 'SpecsController@productIndex')->name('admin.products.specs');
        Route::resource('admin/specs', 'SpecsController', ['as' => 'admin']);

        // 门店
        Route::resource('admin/stores', 'StoresController', ['as' => 'admin']);
        Route::resource('admin/employees', 'EmployeesController', ['as' => 'admin']);
        Route::get('admin/stores/{store}/employees', 'EmployeesController@storeIndex')->name('admin.stores.employees');

        // 客户
        Route::resource('admin/members', 'MembersController', ['as' => 'admin']);
        // Route::resource('admin/cars', 'CarsController', ['as' => 'admin']);

        // 订单
        // Route::resource('admin/orders', 'OrdersController', ['as' => 'admin']);



    });


});

Route::resource('car_brands', 'CarBrandsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('commissions', 'CommissionsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);