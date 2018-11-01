<?php

namespace App\Http\Controllers\Store;

use App\Models\Car;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {

        $manager = \Auth::guard('store')->user();

        $store = $manager->store;

        $productCount = Product::all()->count();
        $orderSum = $store->orders()->where('orders.status', 1)->sum('money');
        $orderMonthCount = $store->orders()->where('orders.status', 1)->where('dealt_at', '>=', Carbon::now()->firstOfMonth())->count();
        $orderMonthSum = $store->orders()->where('orders.status', 1)->where('dealt_at', '>=', Carbon::now()->firstOfMonth())->sum('money');

        return view('store.common.welcome', compact('manager', 'orderSum', 'orderMonthCount', 'orderMonthSum', 'productCount'));
    }
}
