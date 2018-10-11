<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Order;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $admin = \Auth::guard('admin')->user();
        $storeCount = Store::count();
        // $orderCount = Order::where('status', 1)->count();
        $orderSum = Order::where('status', 1)->sum('money');
        $orderMonthCount = Order::where('status', 1)
            ->where('dealt_at', '>=', Carbon::now()->firstOfMonth())->count();
        $orderMonthSum = Order::where('status', 1)
            ->where('dealt_at', '>=', Carbon::now()->firstOfMonth())->sum('money');


        return view('admin.common.welcome', compact('admin', 'storeCount', 'orderSum', 'orderMonthCount', 'orderMonthSum'));
    }
}
