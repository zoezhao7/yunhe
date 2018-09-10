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

        #用户
        $api->post('login', 'AuthorizationsController@store');
        $api->post('logout', 'AuthorizationsController@destroy');
        $api->post('token/refresh', 'AuthorizationsController@refreshToken');




    });
});

$api->version('v2', function($api) {
   $api->get('version', function() {
       return response('this is version v2');
   });
});