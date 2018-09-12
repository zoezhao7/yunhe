<?php

namespace App\Transformers;

use App\Models\Product;
use App\Models\Spec;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected  $availableIncludes = ['category', 'specs'];

    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'discount' => $product->discount ? $product->discount . '%' : '无',
            'intro' => $product->intro,
            'colors' => $product->colors,

        ];
    }

    public function includeCategory(Product $product)
    {
        return $this->item($product->category, new CategoryTransformer());
    }

    public function includeSpecs(Product $product)
    {
        return $this->collection($product->specs, new SpecTransformer());
    }
}