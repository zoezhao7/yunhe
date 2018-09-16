<?php

Route::namespace('Store')->middleware(['clean.form'])->group(function () {
    #Auth
    Route::get('store/login', 'LoginController@showLoginForm')->name('store.login');
    Route::post('store/login', 'LoginController@login')->name('store.login.post');

    Route::middleware(['auth:store'])->group(function () {
        #欢迎页
        Route::get('store/welcome', 'WelcomeController@index')->name('store.welcome');
        #产品管理
        Route::get('store/products/{product}/specs', 'SpecsController@productIndex')->name('store.products.specs');
        Route::get('store/products', 'ProductsController@index')->name('store.products.index');
        Route::get('store/products/{product}', 'ProductsController@show')->name('store.products.show');
        #员工管理
        Route::resource('store/employees', 'EmployeesController', ['as' => 'store']);
        #客户管理
        Route::resource('store/members', 'MembersController', ['as' => 'store']);
        #订单管理
        Route::put('store/orders/{order}/check_success', 'OrdersController@checkSuccess')->name('store.orders.check_success');
        Route::put('store/orders/{order}/check_fail', 'OrdersController@checkFail')->name('store.orders.check_fail');
        Route::get('store/orders', 'OrdersController@index')->name('store.orders.index');
        Route::get('store/orders/{order}', 'OrdersController@show')->name('store.orders.show');
    });
});

Route::namespace('Admin')->middleware(['clean.form'])->group(function () {
    #Auth
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'LoginController@login')->name('admin.login.post');

    Route::middleware(['auth.admin'])->group(function () {
        Route::post('admin/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('admin/welcome', 'WelcomeController@index')->name('admin.welcome');
    });

    Route::middleware(['auth.admin', 'admin.permission'])->group(function () {
        #权限
        Route::resource('admin/nodes', 'NodesController', ['as' => 'admin']);
        Route::resource('admin/roles', 'RolesController', ['as' => 'admin']);
        Route::resource('admin/admins', 'AdminsController', ['as' => 'admin']);
        #产品
        Route::resource('admin/categories', 'CategoriesController', ['as' => 'admin']);
        Route::resource('admin/products', 'ProductsController', ['as' => 'admin']);
        Route::get('admin/products/{product}/specs', 'SpecsController@productIndex')->name('admin.products.specs');
        Route::resource('admin/specs', 'SpecsController', ['as' => 'admin']);
        #门店
        Route::resource('admin/stores', 'StoresController', ['as' => 'admin']);
        Route::resource('admin/employees', 'EmployeesController', ['as' => 'admin']);
        Route::get('admin/stores/{store}/employees', 'EmployeesController@storeIndex')->name('admin.stores.employees');
        #客户
        Route::resource('admin/members', 'MembersController', ['as' => 'admin']);
        #Route::resource('admin/cars', 'CarsController', ['as' => 'admin']);
        #订单
        #Route::resource('admin/orders', 'OrdersController', ['as' => 'admin']);
    });

});