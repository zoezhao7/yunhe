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

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['member', 'orderProducts'];

    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'product_id' => $order->product_id,
            'spec_id' => $order->spec_id,
            'member_id' => $order->member_id,
            'car_id' => $order->car_id,
            'price' => $order->price,
            'discount' => $order->discount == 0 ? '无' : $order->discount * 100 . '%',
            'money' => $order->money,
            'dealt_at' => $order->dealt_at,
            'status' => $order->status,
        ];
    }

    public function includeOrderProducts(Order $order)
    {
        return $this->collection($order->orderProducts, new OrderProductTransformer());
    }

    public function includeMember(Order $order)
    {
        return $this->item($order->member, new MemberTransformer());
    }
}