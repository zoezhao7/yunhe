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
            if ($spec) {
                return redirect()->route('admin.specs.show', $spec->id);
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
        unset($data['_token']);

        // 轮毂色彩数组 Json
        $productColors = [];
        $colors = $request->colors;
        if (isset($colors['file'])) {
            foreach ($colors['file'] as $key => $file) {
                if (is_file($file) && isset($colors['title'][$key])) {
                    $result = $uploader->save($file, 'product_colors', '', 750);
                    $productColors[] = [
                        'title' => $colors['title'][$key],
                        'path' => $result['path'],
                    ];
                }
            }
        }
        $data['colors'] = json_encode($productColors);
        if ($request->image) {
            $result = $uploader->save($request->image, 'products', 750);
            if ($result) {
                $data['image'] = $result['path'];
            }
        }
        $data['created_at'] = now();

        Product::insert($data);

        return redirect()->route('admin.products.index')->with('success', '产品添加成功！');
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

        $productColors = [];
        $colors = $request->colors;

        if (isset($colors['file'])) {
            foreach ($colors['file'] as $key => $file) {
                if (is_file($file) && $colors['title'][$key]) {
                    $result = $uploader->save($file, 'product_colors', $product->id, 750);
                    if ($result) {
                        $productColors[] = [
                            'title' => $colors['title'][$key],
                            'path' => $result['path'],
                        ];
                    }
                }
            }
        }
        if (isset($colors['path'])) {
            foreach ($colors['path'] as $key => $path) {
                $productColors[] = [
                    'title' => $colors['title'][$key],
                    'path' => $colors['path'][$key],
                ];
            }
        }
        $data['colors'] = json_encode($productColors);

        // 产品照片
        if ($request->image) {
            $result = $uploader->save($request->image, 'products', $product->id, 750);
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