<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $category_ids = Category::all()->pluck('id');
        $images = [
            'http://yunhe.test/images/products/demo/1.png',
            'http://yunhe.test/images/products/demo/2.png',
            'http://yunhe.test/images/products/demo/3.png',
            'http://yunhe.test/images/products/demo/4.png',
            'http://yunhe.test/images/products/demo/5.png',
            'http://yunhe.test/images/products/demo/6.png',
        ];

        $products = factory(Product::class)->times(50)->make()->each(function ($product, $index) use ($faker, $images, $category_ids) {
            $product->category_id = $faker->randomElement($category_ids);
            $product->image = $faker->randomElement($images);
        });

        Product::insert($products->toArray());
    }

}

