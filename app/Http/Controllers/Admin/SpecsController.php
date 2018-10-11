<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecRequest;

class SpecsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $specs = Spec::recent()->paginate();
        return view('admin.specs.index', compact('specs'));
    }

    public function show(Spec $spec)
    {
        return view('admin.specs.show', compact('spec'));
    }

    public function productIndex(Product $product)
    {
        $specs = $product->specs()->recent()->paginate();
        return view('admin.specs.index', compact('specs', 'product'));
    }

    public function create(Spec $spec, Product $product)
    {
        return view('admin.specs.create_and_edit', compact('spec', 'product'));
    }

    public function store(SpecRequest $request)
    {
        $data = $request->only('product_id', 'idnumber', 'size', 'price', 'param_key', 'param_value');

        if (!empty($data['param_key'])) {
            foreach ($data['param_key'] as $key => $value) {
                $content[$value] = isset($data['param_value'][$key]) ? $data['param_value'][$key] : '';
            }
            $data['content'] = json_encode($content);
        }

        Spec::create($data);
        return redirect()->route('admin.products.specs', $data['product_id'])->with('success', '产品型号添加成功！');
    }

    public function edit(Spec $spec)
    {
        // $this->authorize('update', $spec);

        $product = $spec->product;
        return view('admin.specs.create_and_edit', compact('spec', 'product'));
    }

    public function update(SpecRequest $request, Spec $spec)
    {
        // $this->authorize('update', $spec);
        $data = $request->all();

        if (!empty($data['param_key'])) {
            foreach ($data['param_key'] as $key => $value) {
                $content[$value] = isset($data['param_value'][$key]) ? $data['param_value'][$key] : '';
            }
            $data['content'] = json_encode($content);
        }

        $spec->update($data);

        return redirect()->back()->with('success', '产品型号更新成功！');
    }

    public function destroy(Spec $spec)
    {
        // $this->authorize('destroy', $spec);
        $spec->idnumber = $spec->idnumber;
        $spec->delete();

        return redirect()->route('admin.products.specs', $spec->product_id)->with('success', "编号为 [{$spec->idnumber}] 的产品型号删除成功！");
    }
}