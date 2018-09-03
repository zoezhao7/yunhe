<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = factory(Product::class)->times(50)->make()->each(function ($product, $index) {
            if ($index == 0) {
                // $product->field = 'value';
            }
        });

        Product::insert($products->toArray());
    }

}

