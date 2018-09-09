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
		$products = Product::with('specs')->recent()->paginate();

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
        $categories = Category::all();
        $product->colors = json_decode($product->colors, true);

		return view('admin.products.create_and_edit', compact('product', 'categories'));
	}

	public function update(ProductRequest $request, Product $product, ImageUploadHandler $uploader)
	{
		//$this->authorize('update', $product);
        $data = $request->all();

        // 轮毂色彩数组 Json
        $colors = json_decode($product->colors, true);
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