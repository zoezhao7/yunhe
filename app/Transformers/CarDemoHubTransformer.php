<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/13
 * Time: 15:13
 */

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class CarDemoHubTransformer extends TransformerAbstract
{

    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
        ];
    }

}