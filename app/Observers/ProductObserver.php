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

    public function deleting(Product $product)
    {

        denied('该产品已存在订单， 不允许删除！');
    }

    public function deleted(Product $product)
    {
        \DB::table('specs')->where('product_id', $product->id)->delete();
    }
}