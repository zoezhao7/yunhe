<?php

namespace App\Http\Controllers\Store;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $manager = \Auth::guard('store')->user();

        $query = Order::selectRaw('orders.*, members.name as member_name, employees.name as employee_name, specs.size as spec_size, products.name as product_name')
            ->leftJoin('specs', 'orders.spec_id', '=', 'specs.id')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->leftJoin('members', 'orders.member_id', '=', 'members.id')
            ->leftJoin('employees', 'members.employee_id', '=', 'employees.id')
            ->where('employees.store_id', '=', $manager->store_id);


        if ($order_idnumber = (string)$request->order_idnumber) {
            $query->where('orders.idnumber', $order_idnumber);
        }
        if ($memberName = (string)$request->member_name) {
            $query->where('members.name', 'like', "%{$memberName}%");
        }
        if ($employeeName = (string)$request->employee_name) {
            $query->where('employees.name', 'like', "%{$employeeName}%");
        }
        if (in_array((string)$request->order_status, ['0', '1', '2'])) {
            $query->where('orders.status', (integer)$request->order_status);
        }
        if ($orderBy = (string)$request->order_by) {
            $query->orderBy((string)$request->order_by, 'desc');
        } else {
            $query->recent();
        }

        $orders = $query->paginate();

        return view('store.orders.index', compact('orders', 'request'));
    }

    public function show(Order $order)
    {
        return view('store.orders.show', compact('order'));
    }

    public function checkSuccess(Order $order)
    {
        if ($order->status > 0) {
            return redirect()->back()->with('danger', '订单已经被审核， 操作失败！');
        }

        $order->status = 1;
        $order->save();

        return redirect()->back()->with('success', '订单已经审核成功！');
    }

    public function checkFail(Order $order)
    {
        if ($order->status > 0) {
            return redirect()->back()->with('danger', '订单已经被审核， 操作失败！');
        }

        $order->status = 2;
        $order->save();

        return redirect()->back()->with('success', '订单已经审核失败！');
    }

}
