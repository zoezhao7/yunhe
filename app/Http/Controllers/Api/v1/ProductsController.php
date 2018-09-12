<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if($request->has('key_word') && $request->key_word) {
            $query->where('name', 'like', '%' . $request->key_word . '%');
        }

        $products = $query->recent()->paginate();

        return $this->response->paginator($products, new ProductTransformer());
    }

    public function categoryIndex(Request $request, Category $category)
    {
        $query = $category->products();

        if($request->has('key_word') && $request->key_word) {
            $query->where('name', 'like', '%' . $request->key_word . '%');
        }
        $products = $query->paginate();

        return $this->response->paginator($products, new ProductTransformer());
    }

    public function show(Product $product)
    {
        return $this->response->item($product, new ProductTransformer());
    }
}
