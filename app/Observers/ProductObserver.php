<?php

namespace App\Observers;

use App\Models\Product;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ProductObserver
{
    public function creating(Product $product)
    {
        //
    }

    public function updating(Product $product)
    {
        //
    }
}