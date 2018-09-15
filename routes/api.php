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

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api\v1',
    // 'middleware' => ['serializer:array', 'bindings', 'change-locale'],
    'middleware' => ['serializer:array', 'bindings'],
], function($api) {

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {

        #登陆
        $api->post('login', 'AuthorizationsController@store');

        $api->group(['middleware' => ['auth:api', 'clean.form']], function ($api) {

            #登出
            $api->post('logout', 'AuthorizationsController@destroy');
            #$api->post('token/refresh', 'AuthorizationsController@refreshToken');

            #客户
            $api->get('members/{member}/orders', 'OrdersController@memberIndex');
            $api->get('members', 'MembersController@index');
            $api->get('members/{member}', 'MembersController@show');

            $api->post('cars', 'CarsController@store');
            $api->get('cars/{car}', 'CarsController@show');
            $api->put('cars/{car}', 'CarsController@update');

            #下线
            $api->get('subordinates', 'EmployeesController@subordinatesIndex');
            $api->get('subordinates/{employee}', 'EmployeesController@subordinatesShow');

            #产品
            $api->get('categories/{category}/products', 'ProductsController@categoryIndex');
            $api->get('products', 'ProductsController@index');
            $api->get('products/{product}', 'ProductsController@show');

            #订单
            $api->get('orders', 'OrdersController@index');
            $api->get('members/{member}/orders', 'OrdersController@memberIndex');
            $api->get('employees/{employee}/orders', 'OrdersController@employeeIndex');
            $api->get('orders/{order}', 'OrdersController@show');
            $api->post('orders', 'OrdersController@store');
            $api->put('orders/{order}', 'OrdersController@update');
            $api->delete('orders/{order}', 'OrdersController@destroy');


            #佣金

            #我的
            $api->get('employees/center', 'EmployeesController@center');
            $api->put('employees/intro', 'EmployeesController@updateIntro');
            $api->put('employees/reset_password', 'EmployeesController@resetPassword');

        });




    });
});

$api->version('v2', function($api) {
   $api->get('version', function() {
       return response('this is version v2');
   });
});