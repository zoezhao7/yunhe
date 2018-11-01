<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Account::observe(\App\Observers\AccountObserver::class);
		\App\Models\Coin::observe(\App\Observers\CoinObserver::class);
		\App\Models\StockOrder::observe(\App\Observers\StockOrderObserver::class);
		\App\Models\Memo::observe(\App\Observers\MemoObserver::class);
		\App\Models\Commission::observe(\App\Observers\CommissionObserver::class);
		\App\Models\CarBrand::observe(\App\Observers\CarBrandObserver::class);
		\App\Models\Order::observe(\App\Observers\OrderObserver::class);
		\App\Models\Spec::observe(\App\Observers\SpecObserver::class);
		\App\Models\Car::observe(\App\Observers\CarObserver::class);
		\App\Models\Member::observe(\App\Observers\MemberObserver::class);
		\App\Models\Employee::observe(\App\Observers\EmployeeObserver::class);
		\App\Models\Category::observe(\App\Observers\CategoryObserver::class);
		\App\Models\Store::observe(\App\Observers\StoreObserver::class);
		\App\Models\Product::observe(\App\Observers\ProductObserver::class);
		\App\Models\Role::observe(\App\Observers\RoleObserver::class);
		\App\Models\Admin::observe(\App\Observers\AdminObserver::class);
        \App\Models\EmployeeRole::observe(\App\Observers\EmployeeRoleObserver::class);

        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
