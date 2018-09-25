<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Coin::class => \App\Policies\CoinPolicy::class,
		 \App\Models\Project::class => \App\Policies\ProjectPolicy::class,
		 \App\Models\StockOrder::class => \App\Policies\StockOrderPolicy::class,
		 \App\Models\Memo::class => \App\Policies\MemoPolicy::class,
		 \App\Models\Commission::class => \App\Policies\CommissionPolicy::class,
		 \App\Models\CarBrand::class => \App\Policies\CarBrandPolicy::class,
		 \App\Models\Order::class => \App\Policies\OrderPolicy::class,
		 \App\Models\Spec::class => \App\Policies\SpecPolicy::class,
		 \App\Models\Car::class => \App\Policies\CarPolicy::class,
		 \App\Models\Member::class => \App\Policies\MemberPolicy::class,
		 \App\Models\Employee::class => \App\Policies\EmployeePolicy::class,
		 \App\Models\Staff::class => \App\Policies\StaffPolicy::class,
		 \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
		 \App\Models\Store::class => \App\Policies\StorePolicy::class,
		 \App\Models\Product::class => \App\Policies\ProductPolicy::class,
		 \App\Models\Role::class => \App\Policies\RolePolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
