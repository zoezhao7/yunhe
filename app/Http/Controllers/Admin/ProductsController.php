<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Handlers\ImageUploadHandler;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

	public function index()
	{
		$products = Product::recent()->paginate();

		return view('admin.products.index', compact('products'));
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

        if ($request->image) {
            $result = $uploader->save($request->image, 'avatars');
            if ($result) {
                $data['image'] = $result['path'];
            }
        }

        Product::insert($data);
        
		return redirect()->route('admin.products.index', $product->id)->with('success', '产品添加成功！');
	}

	public function edit(Product $product)
	{
        $categories = Category::all();
        $this->authorize('update', $product);
		return view('admin.products.create_and_edit', compact('product', 'categories'));
	}

	public function update(ProductRequest $request, Product $product)
	{
		$this->authorize('update', $product);
		$product->update($request->all());

		return redirect()->route('admin.products.index', $product->id)->with('success', '产品编辑成功！');
	}

	public function destroy(Product $product)
	{
		$this->authorize('destroy', $product);
		$product->delete();

		return redirect()->route('admin.products.index')->with('success', '产品删除成功！');
	}
}