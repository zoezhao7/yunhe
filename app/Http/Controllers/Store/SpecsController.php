<?php

namespace App\Http\Controllers\Store;

use App\Models\Product;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecRequest;
use App\Models\Hub;

class SpecsController extends Controller
{
	public function index()
	{
		$specs = Spec::recent()->paginate();
		return view('store.specs.index', compact('specs'));
	}

	public function productIndex(Product $product)
    {
        $specs = $product->specs()->recent()->paginate();
        return view('store.specs.product_index', compact('specs', 'product'));
    }

    public function show(Spec $spec)
    {
        $manager = \Auth::guard('store')->user();
        $hubs = Hub::where('store_id', $manager->store_id)->where('spec_id', $spec->id)->orderBy('order_id', 'asc')->orderBy('id', 'desc')->get();
        return view('store.specs.show', compact('spec', 'hubs'));
    }

	public function create(Spec $spec)
	{
		return view('store.specs.create_and_edit', compact('spec'));
	}

	public function store(SpecRequest $request)
	{
		$spec = Spec::create($request->all());
		return redirect()->route('store.specs.index')->with('message', '产品规格添加成功！');
	}

	public function edit(Spec $spec)
	{
        // $this->authorize('update', $spec);
		return view('store.specs.create_and_edit', compact('spec'));
	}

	public function update(SpecRequest $request, Spec $spec)
	{
		// $this->authorize('update', $spec);
		$spec->update($request->all());

		return redirect()->route('store.specs.index')->with('message', '产品规格编辑成功！');
	}

	public function destroy(Spec $spec)
	{
		// $this->authorize('destroy', $spec);
		$spec->delete();

		return redirect()->route('store.specs.index')->with('message', '产品规格删除成功！');
	}
}