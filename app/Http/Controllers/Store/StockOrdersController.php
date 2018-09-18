<?php

namespace App\Http\Controllers\Store;

use App\Models\Product;
use App\Models\StockOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockOrderRequest;

class StockOrdersController extends Controller
{
	public function index()
	{
		$stock_orders = StockOrder::paginate();
		return view('store/stock_orders.index', compact('stock_orders'));
	}

    public function show(StockOrder $stock_order)
    {
        return view('store/stock_orders/show', compact('stock_order'));
    }

	public function create(StockOrder $stock_order, Product $product)
	{
		return view('store/stock_orders/create_and_edit', compact('stock_order', 'product'));
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

	public function edit(StockOrder $stock_order)
	{
        $this->authorize('update', $stock_order);
		return view('store/stock_orders/create_and_edit', compact('stock_order'));
	}

	public function update(StockOrderRequest $request, StockOrder $stock_order)
	{
		$this->authorize('update', $stock_order);
		$stock_order->update($request->all());

		return redirect()->route('store.stock_orders.show', $stock_order->id)->with('success', '订单更新成功！');
	}

	public function destroy(StockOrder $stock_order)
	{
		$this->authorize('destroy', $stock_order);
		$stock_order->delete();
		return redirect()->route('store.stock_orders.index')->with('success', '订单删除成功！');
	}
}