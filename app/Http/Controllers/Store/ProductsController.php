<?php

namespace App\Http\Controllers\Store;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Spec;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('specs')->recent();

        if ($productName = (string)$request->spec_idnumber) {
            $spec = Spec::where('number', $request->spec_idnumber)->first();
            if($spec) {
                return redirect()->route('store.products.specs', $spec->product_id);
            }
        }
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