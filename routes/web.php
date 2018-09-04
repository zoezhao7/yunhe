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

Route::resource('products', 'ProductsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('stores', 'StoresController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::namespace('Admin')->middleware([])->group(function() {
    Route::get('admin/welcome', 'WelcomeController@index')->name('admin.welcome');
    Route::resource('admin/nodes', 'NodesController', ['as' => 'admin']);
    // Route::resource('admin/roles', 'RolesController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    // Route::resource('admin/admins', 'AdminsController', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
});