<?php

namespace App\Http\Controllers\Admin;

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
		$stores = Store::recent()->paginate();
		return view('admin.stores.index', compact('stores'));
	}

    public function show(Store $store)
    {
        return view('admin.stores.show', compact('store'));
    }

	public function create(Store $store)
	{
		return view('admin.stores.create_and_edit', compact('store'));
	}

	public function store(StoreRequest $request)
	{
		$store = Store::create($request->all());
		return redirect()->route('admin.stores.index', $store->id)->with('success', '门店创建成功！');
	}

	public function edit(Store $store)
	{
        // $this->authorize('update', $store);
		return view('admin.stores.create_and_edit', compact('store'));
	}

	public function update(StoreRequest $request, Store $store)
	{
		// $this->authorize('update', $store);
		$store->update($request->all());

		return redirect()->route('admin.stores.index', $store->id)->with('success', '门店编辑成功！');
	}

	public function destroy(Store $store)
	{
		// $this->authorize('destroy', $store);
		$store->delete();

		return redirect()->route('admin.stores.index')->with('success', '门店删除成功！');
	}
}