<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\StockOrderProductRequest;
use App\Models\Hub;
use App\Models\Product;
use App\Models\StockOrderProduct;
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

		$query = $store->stockOrders()->with('stockOrderProducts.spec.product')->recent();

        if ($stockOrderIdnumber = (string)$request->stock_order_idnumber) {
            $query->where('idnumber', $stockOrderIdnumber);
        }
        if ($orderStatus = (int)$request->order_status) {
            $query->where('status', $orderStatus);
        }

        $stockOrders = $query->paginate();

		return view('store/stock_orders.index', compact('stockOrders', 'request'));
	}

	// 订单详情
    public function show(StockOrder $stockOrder)
    {
        $stockOrderProducts = $stockOrder->stockOrderProducts()->with(['spec.product.category', 'hubs'])->get();
        return view('store/stock_orders/show', compact('stockOrder', 'stockOrderProducts'));
    }


	public function create(StockOrderProduct $stockOrderProduct, Spec $spec)
	{
	    $product = $spec->product;
		return view('store/stock_orders/create_and_edit', compact('stockOrderProduct', 'product', 'spec'));
	}

	// 向备货清单中添加产品
	public function addProduct(StockOrderProductRequest $request)
    {
        $data = $request->except('_token');
        StockOrderProduct::create($data);
        return redirect()->route('store.stock_orders.shopping_cart')->with('success', '成功添加到备货订单中！');
    }

    public function destroyProduct(StockOrderProduct $stockOrderProduct)
    {
        $stockOrderProduct->delete();
        return redirect()->back()->with('success', '成功从备货清单中删除！');
    }

    // 备货订单购物车
    public function shoppingCart()
    {
        $products = StockOrderProduct::with('spec.product')->where('stock_order_id', 0)->get();
        return view('store.stock_orders.shopping_cart', compact('products'));
    }

    // 提交备货订单
    public function store(StockOrderRequest $request, StockOrder $stockOrder)
    {
        $manager = \Auth::guard('store')->user();

        $data = $request->all();

        $stockOrderProducts = StockOrderProduct::where('stock_order_id', 0)->get();

        if($stockOrderProducts->isEmpty()) {
            return response(['success'=>false, 'message'=>'备货清单中没有货物，请刷新后重试！']);
        }

        foreach($request->numbers as $key=>$value)
        {
            StockOrderProduct::where('id', $value['id'])->update(['number'=>$value['number']]);
        }

        $stockOrder->remark = $request->remark;
        $stockOrder->store_id = $manager->store_id;
        $stockOrder->employee_id = $manager->id;

        $stockOrder->save();

        return response(['success'=>true, 'data'=>['stock_order_id'=> $stockOrder->id]]);
    }

    // 编辑备货订单
	public function edit(StockOrder $stockOrder)
	{
	    $product = $stockOrder->product;
	    $spec = $stockOrder->spec;
		return view('store/stock_orders/create_and_edit', compact('stockOrder', 'product', 'spec'));
	}

	// 更新备货订单
	public function update(StockOrderRequest $request, StockOrder $stock_order)
	{
		// $this->authorize('update', $stock_order);
		$stock_order->update($request->all());

		return redirect()->back()->with('success', '备货订单更新成功！');
	}

	// 删除备货订单
	public function destroy(StockOrder $stockOrder)
	{
		// $this->authorize('destroy', $stock_order);
        $stockOrder->delete();
		return redirect()->route('store.stock_orders.index')->with('success', '备货订单删除成功！');
	}

	// 确认收货
	public function received(StockOrder $stockOrder)
    {
        if($stockOrder->status !== 2) {
            return ['success' => false, 'message' => '订单状态异常，请刷新后重试！'];
        }

        $manager = \Auth::guard('store')->user();

        $stockOrder->status = 3;
        $stockOrder->received_at = now();
        $stockOrder->save();

        Hub::where('stock_order_id', $stockOrder->id)->update(['store_id' => $manager->store_id, 'status' => 2]);

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