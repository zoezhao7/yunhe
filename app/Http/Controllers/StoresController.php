<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;

class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$stores = Store::paginate();
		return view('stores.index', compact('stores'));
	}

    public function show(Store $store)
    {
        return view('stores.show', compact('store'));
    }

	public function create(Store $store)
	{
		return view('stores.create_and_edit', compact('store'));
	}

	public function store(StoreRequest $request)
	{
		$store = Store::create($request->all());
		return redirect()->route('stores.show', $store->id)->with('message', 'Created successfully.');
	}

	public function edit(Store $store)
	{
        $this->authorize('update', $store);
		return view('stores.create_and_edit', compact('store'));
	}

	public function update(StoreRequest $request, Store $store)
	{
		$this->authorize('update', $store);
		$store->update($request->all());

		return redirect()->route('stores.show', $store->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Store $store)
	{
		$this->authorize('destroy', $store);
		$store->delete();

		return redirect()->route('stores.index')->with('message', 'Deleted successfully.');
	}
}