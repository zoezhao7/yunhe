<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $carBrands = \App\Models\CarBrand::all()->pluck('name');

        $category_ids = Category::all()->pluck('id');
        $images = [
            'http://yunhe.test/images/products/demo/1.png',
            'http://yunhe.test/images/products/demo/2.png',
            'http://yunhe.test/images/products/demo/3.png',
            'http://yunhe.test/images/products/demo/4.png',
            'http://yunhe.test/images/products/demo/5.png',
            'http://yunhe.test/images/products/demo/6.png',
        ];

        $colors = [
            ['title' => '黑宝石色', 'path' => 'http://yunhe.test/images/products/demo/1.png'],
            ['title' => '月光蓝', 'path' => 'http://yunhe.test/images/products/demo/2.png'],
            ['title' => '极地白', 'path' => 'http://yunhe.test/images/products/demo/3.png'],
            ['title' => '珍珠白', 'path' => 'http://yunhe.test/images/products/demo/4.png'],
            ['title' => '红酒色', 'path' => 'http://yunhe.test/images/products/demo/5.png'],
        ];

        $products = factory(Product::class)
            ->times(50)
            ->make()
            ->each(function ($product, $index) use ($faker, $images, $category_ids, $colors, $carBrands) {

            $product->category_id = $faker->randomElement($category_ids);
            $product->image = $faker->randomElement($images);

            $color_arr[] = $faker->randomElement($colors);
            $color_arr[] = $faker->randomElement($colors);
            $product->colors = json_encode($color_arr);
            $carBrand_arr[]['name'] = $faker->randomElement($carBrands);
            $carBrand_arr[]['name'] = $faker->randomElement($carBrands);
            $product->fit_brands = json_encode($carBrand_arr);
        });

        Product::insert($products->toArray());
    }

}

