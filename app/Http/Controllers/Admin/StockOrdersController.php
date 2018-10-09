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
        //$order = StockOrder::find(3)
        return view('admin.stock_orders.show', compact('stockOrder', 'product', 'spec'));
    }

    public function index(Request $request)
    {

        $query = StockOrder::with('store', 'product', 'spec')->recent();

        if ($stockOrderIdnumber = (string)$request->stock_order_idnumber) {
            $query->where('idnumber', $stockOrderIdnumber);
        }
        if ($orderStatus = (int)$request->order_status) {
            $query->where('status', $orderStatus);
        }
        if ($productName = (string)$request->product_name) {
            $productIds = Product::where('name', 'like', "%{$productName}%")->pluck('id');
            $query->whereIn('product_id', $productIds);
        }
        if ($specNumber = (string)$request->spec_idnumber) {
            $spec = Spec::where('number', $specNumber)->first();
            if ($spec) {
                $query->where('spec_id', $spec->id);
            } else {
                $query->where('spec_id', 0);
            }
        }

        $stockOrders = $query->paginate();

        return view('admin.stock_orders.index', compact('request', 'stockOrders'));
    }

    public function edit(StockOrder $order)
    {
        return view('admin.stock_orders.create_and_edit', compact('order'));
    }

    public function update()
    {

    }

    public function orderTaking(StockOrder $stockOrder)
    {
        if($stockOrder->status > 0)
        {
            return response(['success'=>false, 'message'=>'订单状态异常，请刷新页面！']);
        }
        $stockOrder->status = 1;
        $stockOrder->receipted_at = now();
        $stockOrder->save();
        return response(['success'=>true, 'message'=>'']);
    }

    public function delivery(DelivelyRequest $request, StockOrder $stockOrder)
    {
        if($stockOrder->status !== 1)
        {
            return response(['success'=>false, 'message'=>'订单状态异常，请刷新页面！']);
        }
        $data = $request->all();
        $stockOrder->status = 2;
        $stockOrder->delivery_number = $data['delivery_number'];
        $stockOrder->delivery_note = $data['delivery_note'];
        $stockOrder->delivered_at = $data['delivered_at'];
        $stockOrder->save();

        return redirect()->back()->with('success', '发货操作成功！');
    }
}
