<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\v1'], function($api) {

        #登陆
        $api->post('login', 'AuthorizationsController@store');

        $api->group(['middleware' => ['auth:api']], function ($api) {
            $api->post('logout', 'AuthorizationsController@destroy');
            #$api->post('token/refresh', 'AuthorizationsController@refreshToken');

            #客户
            $api->get('members/{member}/orders', 'OrdersController@memberIndex');
            $api->get('members', 'MembersController@index');

            #产品
            $api->get('products', 'ProductsController@index');
            $api->get('categories/{category}/}products', 'ProductsController@categoryIndex');
            $api->get('products/{product}', 'ProductsController@show');

            #订单

            #佣金

        });




    });
});

$api->version('v2', function($api) {
   $api->get('version', function() {
       return response('this is version v2');
   });
});