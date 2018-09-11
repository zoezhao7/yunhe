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
        $products = Product::recent()->paginate();

        return $this->response->paginator($products, new ProductTransformer())->addMeta('123', '123');
    }

    public function categoryIndex(Request $request, Category $category)
    {
        $products = $category->products()->paginate();

        return $this->response->paginator($products, new ProductTransformer());
    }

    public function show(Product $product)
    {
        return $this->response->item($product, new ProductTransformer());
    }
}
