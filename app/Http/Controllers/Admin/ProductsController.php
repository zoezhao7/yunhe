<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Product;
use App\Models\Spec;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

	public function index(Request $request)
	{
        $query = Product::query()->with('specs')->recent();

        if ($productName = (string)$request->spec_idnumber) {
            $spec = Spec::where('idnumber', $request->spec_idnumber)->first();
            if($spec) {
                return redirect()->route('admin.products.specs', $spec->product_id);
            }
        }
        if ($productName = (string)$request->product_name) {
            $query->where('name', 'like', "%{$productName}%");
        }
        if ($categoryId = (string)$request->category_id) {
            $query->where('category_id', $categoryId);
        }

		$products = $query->paginate();

		$categories = Category::select('id', 'name')->get();

		return view('admin.products.index', compact('products', 'request', 'categories'));
	}

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

	public function create(Product $product)
	{
        $categories = Category::all();
		return view('admin.products.create_and_edit', compact('product', 'categories'));
	}

	public function store(ProductRequest $request, ImageUploadHandler $uploader)
	{
		$data = $request->all();

        // 轮毂色彩数组 Json
        $colors = [];
        foreach($request->colors as $color) {
            if(isset($color['path'])) {
                $result = $uploader->save($color['path'], 'product_colors', $product->id,  750);
                $colors[] = [
                    'title' => $color['title'],
                    'path' => $result['path'],
                ];
            }
        }
        $product->colors = json_encode($colors);

        if ($request->image) {
            $result = $uploader->save($request->image, 'products', 750);
            if ($result) {
                $data['image'] = $result['path'];
            }
        }

        Product::insert($data);
        
		return redirect()->route('admin.products.index', $product->id)->with('success', '产品添加成功！');
	}

	public function edit(Product $product)
	{
        //$this->authorize('update', $product);
        $categories = Category::select('id', 'name')->get();

		return view('admin.products.create_and_edit', compact('product', 'categories'));
	}

	public function update(ProductRequest $request, Product $product, ImageUploadHandler $uploader)
	{
		//$this->authorize('update', $product);
        $data = $request->all();

        foreach($colors as $key => $color) {
            if(!isset($request->edit_colors[$key])) {
                unset($colors[$key]);
            }
            if(isset($request->edit_colors[$key]['path']) && $request->edit_colors[$key]['path']) {
                $result = $uploader->save($request->edit_colors[$key]['path'], 'product_colors', $product->id,  750);
                $colors[$key]['path'] = $result['path'];
            }

            $colors[$key]['title'] = $request->edit_colors[$key]['title'];
        }
        foreach($request->colors as $color) {
            if(isset($color['path'])) {
                $result = $uploader->save($color['path'], 'product_colors', $product->id,  750);
                $colors[] = [
                    'title' => $color['title'],
                    'path' => $result['path'],
                ];
            }
        }
        $product->colors = json_encode($colors);

        // 产品照片
        if ($request->image) {
            $result = $uploader->save($request->image, 'products', $product->id,  750);
            if ($result) {
                $data['image'] = $result['path'];
            }
        }

		$product->update($data);

		return redirect()->route('admin.products.index', $product->id)->with('success', '产品编辑成功！');
	}

	public function destroy(Product $product)
	{
		//$this->authorize('destroy', $product);

        $product->delete();

		return redirect()->route('admin.products.index')->with('success', '产品删除成功！');
	}
}