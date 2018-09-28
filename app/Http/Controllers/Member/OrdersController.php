<?php

namespace App\Http\Controllers\Member;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        dd('this is orders index page');
    }

    public function show(Request $request, Order $order)
    {
        dd('this is orders show page');
    }
}
