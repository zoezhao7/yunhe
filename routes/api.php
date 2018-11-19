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

Route::options('/{all}',function(){
    return response('ok')
        ->header('Access-Control-Allow-Methods','POST, GET, OPTIONS, PUT, DELETE')
        ->header('Access-Control-Allow-Headers','Content-Type, X-Auth-Token, Origin');
})->where(['all' => '([a-zA-Z0-9-]|/)+']);


/*Route::options('/{all}',function(){
    return response('ok')
        ->header('Access-Control-Allow-Methods','POST, GET, OPTIONS, PUT, DELETE')
        ->header('Access-Control-Allow-Headers','Content-Type, X-Auth-Token, Origin');
})->middleware('cors')->where(['all' => '([a-zA-Z0-9-]|/)+']);*/

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

        $api->group(['middleware' => ['auth.api', 'clean.form']], function ($api) {

            #登出
            $api->post('logout', 'AuthorizationsController@destroy');
            #$api->post('token/refresh', 'AuthorizationsController@refreshToken');
            #工作台
            $api->get('workbench', 'WorkbenchController@index');
            $api->get('notifications', 'NotificationsController@index');
            $api->get('workbench/notifications', 'NotificationsController@workbenchIndex');
            #客户
            $api->post('members', 'MembersController@store');
            $api->put('members/{member}', 'MembersController@update');
            $api->get('members/{member}/orders', 'OrdersController@memberIndex');
            $api->get('members', 'MembersController@index');
            $api->get('members/{member}', 'MembersController@show');
            #车辆
            $api->post('cars', 'CarsController@store');
            $api->get('cars/{car}', 'CarsController@show');
            $api->put('cars/{car}', 'CarsController@update');
            $api->delete('cars/{car}', 'CarsController@destroy');
            #车辆品牌
            $api->get('car_brands/{car_brand}/vehicles', 'CarBrandsController@vehicleIndex');
            $api->get('car_brands', 'CarBrandsController@index');
            #服务记录
            $api->get('members/{member}/memos', 'MemosController@memberIndex');
            $api->post('memos', 'MemosController@store');
            $api->put('memos/{memo}', 'MemosController@update');
            $api->delete('memos/{memo}', 'MemosController@destroy');
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
            $api->get('commissions/calculate', 'CommissionsController@calculate');
            $api->get('commissions', 'CommissionsController@index');
            $api->get('commissions/rules', 'CommissionsController@rules');
            #我的
            $api->get('employees/center', 'EmployeesController@center');
            $api->put('employees/intro', 'EmployeesController@updateIntro');
            $api->put('employees/reset_password', 'EmployeesController@resetPassword');
            #车辆轮毂演示
            $api->get('car_demos/cars', 'CarDemosController@cars');
            $api->get('car_demos/hubs', 'CarDemosController@hubs');
        });
    });
});

$api->version('v2', function($api) {
   $api->get('version', function() {
       return response('this is version v2');
   });
});