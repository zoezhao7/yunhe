<?php

namespace App\Http\Controllers\Store;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('specs')->recent();

        if ($productName = (string)$request->product_name) {
            $query->where('name', 'like', "%{$productName}%");
        }
        if ($categoryId = (string)$request->category_id) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate();
        return view('store.products.index', compact('products', 'request', 'categories'));
    }

    public function show(Product $product)
    {
        return view('store.products.show', compact('product'));
    }

}