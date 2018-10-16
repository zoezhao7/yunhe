<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\Store\HubsBinddingOrderRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Hub;

class OrdersController extends Controller
{


    public function index(Request $request)
    {
        $manager = \Auth::guard('store')->user();

        $query = Order::selectRaw('orders.*, members.name as member_name, employees.name as employee_name, em2.name as superior_name')
            ->leftJoin('members', 'orders.member_id', '=', 'members.id')
            ->leftJoin('employees', 'members.employee_id', '=', 'employees.id')
            ->leftJoin('employees as em2', 'employees.superior_id', '=', 'em2.id')
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

    // 订单审核通过
    public function checkSuccess(Order $order)
    {
        if ($order->status > 0) {
            return redirect()->back()->with('danger', '订单已经被审核， 操作失败！');
        }

        if($order->hubs()->count() < $order->orderProducts()->sum('number')) {
            return redirect()->back()->with('danger', '请先添加所有轮毂sn到订单产品！');
        }

        $order->status = 1;
        $order->save();

        Hub::whereIn('order_product_id', $order->orderProducts()->pluck('id'))->update(['status' => 3]);

        return redirect()->back()->with('success', '订单已经审核成功！');
    }

    // 订单审核失败
    public function checkFail(Order $order)
    {
        if ($order->status > 0) {
            return redirect()->back()->with('danger', '订单已经被审核， 操作失败！');
        }

        foreach($order->hubs as $hub) {
            $hub->order_product_id = 0;
            $hub->save();
        }

        $order->status = 2;
        $order->save();

        return redirect()->back()->with('success', '订单已经审核失败！');
    }

    // 订单产品， 绑定sn码
    public function orderProductBinddingHubs(HubsBinddingOrderRequest $request)
    {
        $manager = \Auth::guard('store')->user();
        $msg = '';
        $sn_arr = [];

        Hub::where('store_id', $manager->store_id)->where('order_product_id', $request->order_product_id)->update(['order_product_id' => 0]);
        $hubs = Hub::whereIn('sn', $request->sns)->where('store_id', $manager->store_id)->get();

        // 通过的sn码进行绑定
        foreach($hubs as $hub)
        {
            $sn_arr[] = $hub->sn;
            if($hub->order_product_id>0 && $hub->order_product_id !== $request->order_product_id){
                $msg .= "sn为[" . $hub->sn . "]的轮毂已绑定到其它订单；";
            } else {
                $hub->order_product_id = $request->order_product_id;
                $hub->save();
            }
        }

        // 未查询到的sn码报错信息
        foreach($request->sns as $sn) {
            if(!in_array($sn, $sn_arr)) {
                $msg .= "sn为[" . $sn . "]的轮毂不存在；";
            }
        }

        if($msg) {
            return redirect()->back()->with('danger', $msg);
        } else {
            return redirect()->back()->with('success', '轮毂sn全部通过，绑定成功！');
        }

    }

}

