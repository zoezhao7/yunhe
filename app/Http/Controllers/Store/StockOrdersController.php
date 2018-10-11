<?php

namespace App\Http\Controllers\Store;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockOrderRequest;
use App\Models\Spec;
use App\Models\StockOrder;

class StockOrdersController extends Controller
{
	public function index(Request $request)
	{
	    $manager = \Auth::guard('store')->user();
	    $store = $manager->store;

		$query = $store->stockOrders()->with('product', 'spec')->recent();

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
            if($spec) {
                $query->where('spec_id', $spec->id);
            } else {
                $query->where('spec_id', 0);
            }
        }

        $stockOrders = $query->paginate();

		return view('store/stock_orders.index', compact('stockOrders', 'request'));
	}

    public function show(StockOrder $stockOrder)
    {
        return view('store/stock_orders/show', compact('stockOrder'));
    }

	public function create(StockOrder $stockOrder, Spec $spec)
	{
	    $product = $spec->product;
		return view('store/stock_orders/create_and_edit', compact('stockOrder', 'product', 'spec'));
	}

	public function store(StockOrderRequest $request)
	{
	    $employee = \Auth::guard('store')->user();

	    $data = $request->all();
	    $data['employee_id'] = $employee->id;
	    $data['store_id'] = $employee->store->id;

		StockOrder::create($data);
		
		return redirect()->route('store.stock_orders.index')->with('success', '下单成功，请等待接单！');
	}

	public function edit(StockOrder $stockOrder)
	{
	    $product = $stockOrder->product;
	    $spec = $stockOrder->spec;
		return view('store/stock_orders/create_and_edit', compact('stockOrder', 'product', 'spec'));
	}

	public function update(StockOrderRequest $request, StockOrder $stock_order)
	{
		// $this->authorize('update', $stock_order);
		$stock_order->update($request->all());

		return redirect()->back()->with('success', '备货订单更新成功！');
	}

	public function destroy(StockOrder $stockOrder)
	{
		// $this->authorize('destroy', $stock_order);
        $stockOrder->delete();
		return redirect()->route('store.stock_orders.index')->with('success', '备货订单删除成功！');
	}

	public function received(StockOrder $stockOrder)
    {
        if($stockOrder->status !== 2) {
            return ['success' => false, 'message' => '订单状态异常，请刷新后重试！'];
        }
        $stockOrder->status = 3;
        $stockOrder->received_at = now();
        $stockOrder->save();
        return ['success' => true];
    }

    public function cancel(StockOrder $stockOrder)
    {
        if($stockOrder->status !== 0) {
            return redirect()->back()->with('danger', '订单状态异常， 请刷新后重试！');
        }
        $stockOrder->status = 9;
        $stockOrder->save();
        return redirect()->back()->with('success', '订单取消成功！');
    }
}