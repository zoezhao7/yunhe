<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
	public function index()
	{
		$products = Product::with('specs')->recent()->paginate();

		return view('store.products.index', compact('products'));
	}

    public function show(Product $product)
    {
        return view('store.products.show', compact('product'));
    }

}