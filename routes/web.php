<?php

Route::namespace('Store')->middleware(['clean.form'])->group(function () {
    #Auth
    Route::get('store/login', 'LoginController@showLoginForm')->name('store.login');
    Route::post('store/login', 'LoginController@login')->name('store.login.post');

    Route::middleware(['auth.store'])->group(function () {
        Route::get('store/welcome', 'WelcomeController@index')->name('store.welcome');
        #退出登录
        Route::post('store/logout', 'LoginController@logout')->name('store.logout');
    });

    Route::middleware(['auth.store', 'store.permission'])->group(function () {
        #产品管理
        Route::get('store/products/{product}/specs', 'SpecsController@productIndex')->name('store.products.specs');
        Route::get('store/specs/{spec}', 'SpecsController@show')->name('store.specs.show');
        Route::get('store/specs/', 'SpecsController@index')->name('store.specs.index');
        Route::get('store/products', 'ProductsController@index')->name('store.products.index');
        Route::get('store/products/{product}', 'ProductsController@show')->name('store.products.show');
        #员工管理
        Route::resource('store/employees', 'EmployeesController', ['as' => 'store']);
        #权限管理
        Route::resource('store/nodes', 'NodesController', ['as' => 'store']);
        Route::resource('store/roles', 'RolesController', ['as' => 'store']);
        #积分
        Route::get('store/members/{member}/coins/create', 'CoinsController@memberCreate')->name('store.members.coins.create');
        Route::post('store/members/{member}/coins', 'CoinsController@memberStore')->name('store.members.coins.store');
        Route::get('store/members/{member}/coins', 'CoinsController@memberIndex')->name('store.members.coins');
        Route::resource('store/coins', 'CoinsController', ['only' => ['index'], 'as' => 'store']);
        #客户管理
        Route::resource('store/members', 'MembersController', ['as' => 'store']);
        #订单管理
        Route::get('store/orders/{order}', 'OrderController@show')->name('store.orders.show');
        Route::post('store/order_products/hubs/bindding', 'OrdersController@orderProductBinddingHubs')->name('store.order_products.hubs.bindding');
        Route::put('store/orders/{order}/check_success', 'OrdersController@checkSuccess')->name('store.orders.check_success');
        Route::put('store/orders/{order}/check_fail', 'OrdersController@checkFail')->name('store.orders.check_fail');
        Route::get('store/orders', 'OrdersController@index')->name('store.orders.index');
        Route::get('store/orders/{order}', 'OrdersController@show')->name('store.orders.show');
        #备货订单
        Route::get('store/stock_orders/shopping_cart', 'StockOrdersController@shoppingCart')->name('store.stock_orders.shopping_cart');
        Route::delete('store/stock_orders/product/{stock_order_product}', 'StockOrdersController@destroyProduct')->name('store.stock_orders.product.destroy');
        Route::get('store/specs/{spec}/stock_orders/create', 'StockOrdersController@create')->name('store.specs.stock_orders.create');
        Route::post('store/stock_orders/{stock_order}/received', 'StockOrdersController@received')->name('store.stock_orders.received');
        Route::post('store/stock_orders/{stock_order}/cancel', 'StockOrdersController@cancel')->name('store.stock_orders.cancel');
        Route::resource('store/stock_orders', 'StockOrdersController', ['as' => 'store', 'only' => ['index', 'edit', 'update', 'store', 'destroy', 'show']]);
        Route::post('store/stock_orders/add_product', 'StockOrdersController@addProduct')->name('store.stock_orders.add_product');

        #账务记录
        Route::resource('store/accounts', 'AccountsController', ['only' => ['index', 'create', 'store', 'destroy'], 'as' => 'store']);
        #佣金记录
        Route::resource('store/commissions', 'CommissionsController', ['only' => ['index'], 'as' => 'store']);
        Route::get('store/commissions/make', 'CommissionsController@makeCommissions')->name('store.commissions.make');
        #我的
        Route::get('store/my/password', 'MyController@passwordEdit')->name('store.my.passwordEdit');
        Route::put('store/my/password', 'MyController@passwordUpdate')->name('store.my.passwordUpdate');
        Route::get('store/my/store', 'MyController@storeEdit')->name('store.my.storeEdit');
        Route::put('store/my/store', 'MyController@storeUpdate')->name('store.my.storeUpdate');
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
        #产品尺寸
        Route::get('admin/products/{product}/specs', 'SpecsController@productIndex')->name('admin.products.specs');
        Route::get('admin/products/{product}/specs/create', 'SpecsController@create')->name('admin.products.specs.create');
        Route::resource('admin/specs', 'SpecsController', ['as' => 'admin', 'only' => ['index', 'show', 'edit', 'update', 'store', 'destroy']]);
        #门店
        Route::resource('admin/stores', 'StoresController', ['as' => 'admin']);
        Route::resource('admin/employees', 'EmployeesController', ['as' => 'admin']);
        Route::get('admin/stores/{store}/employees', 'EmployeesController@storeIndex')->name('admin.stores.employees');
        #客户
        Route::resource('admin/members', 'MembersController', ['as' => 'admin']);
        #Route::resource('admin/cars', 'CarsController', ['as' => 'admin']);
        #订单
        #Route::resource('admin/orders', 'OrdersController', ['as' => 'admin']);
        #备货订单
        Route::post('admin/stock_orders/{stock_order}/order_taking', 'StockOrdersController@orderTaking')->name('admin.stock_orders.order_taking');
        Route::post('admin/stock_orders/{stock_order}/delivery', 'StockOrdersController@delivery')->name('admin.stock_orders.delivery');
        Route::resource('admin/stock_orders', 'StockOrdersController', ['as' => 'admin', 'only' => ['index', 'show', 'edit', 'update']]);
        #我的
        Route::get('admin/my/password', 'MyController@passwordEdit')->name('admin.my.password_edit');
        Route::put('admin/my/password', 'MyController@passwordUpdate')->name('admin.my.password_update');
        #轮毂
        Route::post('admin/stock_orders/hubs', 'HubsController@stockOrderStore')->name('admin.stock_orders.hubs.store');
        Route::resource('admin/hubs', 'HubsController', ['as' => 'admin']);
        #佣金规则
        Route::get('admin/commission_rules/edit', 'CommissionRulesController@edit')->name('admin.commission_rules.edit');
        Route::put('admin/commission_rules', 'CommissionRulesController@update')->name('admin.commission_rules.update');
        #汽车轮毂演示
        Route::post('admin/car_demos/upload', 'CarDemosController@upload')->name('admin.car_demos.upload');
        Route::resource('admin/car_demos', 'CarDemosController', ['as' => 'admin']);
    });

});

Route::namespace('Member')->middleware(['clean.form'])->group(function () {
    Route::get('member/login', 'LoginController@login')->name('member.login');
    Route::get('member/weixin_users/{weixin_user}/members', 'MembersController@create')->name('member.members.create');
    Route::post('member/weixin_users/{weixin_user}/members', 'MembersController@store')->name('member.members.store');
    # 发送短信验证码
    Route::post('member/verification_codes', 'VerificationCodesController@store')->name('member.send_code');

    Route::middleware(['auth.member'])->group(function () {
        Route::get('member/center', 'MembersController@center')->name('member.center');
        # 绑定销售顾问
        Route::get('member/edit_employee', 'MembersController@editEmployee')->name('member.members.editEmployee');
        Route::post('member/update_employee', 'MembersController@updateEmployee')->name('member.members.updateEmployee');
        #订单
        Route::get('member/orders', 'OrdersController@index')->name('member.orders');
        Route::get('member/orders/{order}', 'OrdersController@show')->name('member.orders.show');
        #消息
        Route::get('member/notifications', 'NotificationsController@index')->name('member.notifications');
        #积分
        Route::get('member/coins', 'CoinsController@index')->name('member.coins');
    });
});


Route::namespace('Tools')->middleware(['clean.form'])->group(function () {
    Route::get('tools/car_demos', 'CarDemosController@index')->name('tools.car_demos.index');
    Route::get('tools/car_demos/cars', 'CarDemosController@cars')->name('tools.car_demos.cars');
    Route::get('tools/car_demos/hubs', 'CarDemosController@hubs')->name('tools.car_demos.hubs');
});


