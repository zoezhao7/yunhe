<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Product;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected  $availableIncludes = ['products'];

    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
        ];
    }

    public function includeCategory(Category $category)
    {
        return $this->item($category->products, new ProductTransformer());
    }
}