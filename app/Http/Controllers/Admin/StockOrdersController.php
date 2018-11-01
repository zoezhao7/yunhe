<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DelivelyRequest;
use App\Models\StockOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockOrdersController extends Controller
{

    public function show(StockOrder $stockOrder)
    {
        $stockOrderProducts = $stockOrder->stockOrderProducts()->with(['spec.product.category', 'hubs'])->get();
        return view('admin.stock_orders.show', compact('stockOrder', 'stockOrderProducts'));
    }

    public function index(Request $request)
    {
        $query = StockOrder::with('stockOrderProducts.spec.product.category')->recent();

        if ($stockOrderIdnumber = (string)$request->stock_order_idnumber) {
            $query->where('idnumber', $stockOrderIdnumber);
        }
        if ($request->has('order_status')) {
            $query->where('status', (int)$request->order_status);
        }

        $stockOrders = $query->paginate();

        return view('admin.stock_orders.index', compact('request', 'stockOrders'));
    }

    public function edit(StockOrder $order)
    {
        return view('admin.stock_orders.create_and_edit', compact('order'));
    }

    // 接单
    public function orderTaking(StockOrder $stockOrder)
    {
        if ($stockOrder->status > 0) {
            return response(['success' => false, 'message' => '订单状态异常，请刷新页面！']);
        }
        $stockOrder->status = 1;
        $stockOrder->receipted_at = now();
        $stockOrder->save();
        return response(['success' => true, 'message' => '']);
    }

    // 发货
    public function delivery(DelivelyRequest $request, StockOrder $stockOrder)
    {
        if ($stockOrder->status !== 1) {
            return response(['success' => false, 'message' => '订单状态异常，请刷新页面！']);
        }

        foreach($stockOrder->stockOrderProducts as $pro) {
            if($pro->hubs()->count() == 0) {
                return redirect()->back()->with('danger', '请先填写备货清单中，产品的SN码，再进行发货！');
            }
        }

        $data = $request->all();
        $stockOrder->fill($data);
        $stockOrder->status = 2;
        $stockOrder->save();

        return redirect()->back()->with('success', '发货操作成功！');
    }
}
