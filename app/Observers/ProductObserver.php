<?php

namespace App\Observers;

use App\Models\Product;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ProductObserver
{
    public function saving(Product $product)
    {
        $product->content = clean($product->content, 'product_content');
    }
}