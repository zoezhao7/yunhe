<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/13
 * Time: 15:13
 */

namespace App\Transformers;

use App\Models\Order;
use App\Models\OrderProduct;
use League\Fractal\TransformerAbstract;

class OrderProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['spec', 'product'];

    public function transform(OrderProduct $orderProduct)
    {
        return [
            'id' => $orderProduct->id,
            'product_id' => $orderProduct->product_id,
            'spec_id' => $orderProduct->spec_id,
            'color' => $orderProduct->color,
            'number' => $orderProduct->number,
        ];
    }

    public function includeSpec(OrderProduct $orderProduct)
    {
        return $this->item($orderProduct->spec, new SpecTransformer());
    }

    public function includeProduct(OrderProduct $orderProduct)
    {
        return $this->item($orderProduct->product, new ProductTransformer());
    }
}