<?php

namespace App\Http\Controllers;

use App\Models\StockOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockOrderRequest;

class StockOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$stock_orders = StockOrder::paginate();
		return view('stock_orders.index', compact('stock_orders'));
	}

    public function show(StockOrder $stock_order)
    {
        return view('stock_orders.show', compact('stock_order'));
    }

	public function create(StockOrder $stock_order)
	{
		return view('stock_orders.create_and_edit', compact('stock_order'));
	}

	public function store(StockOrderRequest $request)
	{
		$stock_order = StockOrder::create($request->all());
		return redirect()->route('stock_orders.show', $stock_order->id)->with('message', 'Created successfully.');
	}

	public function edit(StockOrder $stock_order)
	{
        $this->authorize('update', $stock_order);
		return view('stock_orders.create_and_edit', compact('stock_order'));
	}

	public function update(StockOrderRequest $request, StockOrder $stock_order)
	{
		$this->authorize('update', $stock_order);
		$stock_order->update($request->all());

		return redirect()->route('stock_orders.show', $stock_order->id)->with('message', 'Updated successfully.');
	}

	public function destroy(StockOrder $stock_order)
	{
		$this->authorize('destroy', $stock_order);
		$stock_order->delete();

		return redirect()->route('stock_orders.index')->with('message', 'Deleted successfully.');
	}
}