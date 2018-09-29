<?php

namespace App\Http\Controllers\Member;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $member = \Auth::guard('member')->user();

        $orders = $member->orders()->recent()->where('status', 1)->get();

        return view('member.orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        dd('this is orders show page');
    }
}
