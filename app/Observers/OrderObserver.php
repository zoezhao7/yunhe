<?php

namespace App\Observers;

use App\Models\Car;
use App\Models\Order;
use App\Models\Spec;
use Dingo\Api\Routing\Helpers;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class OrderObserver
{
    use Helpers;

    public function creating(Order $order)
    {
        // 添加市场价、折扣、产品id
        $spec = Spec::find($order->spec_id);
        $order->price = $spec->price;
        $order->discount = $spec->discount;
        $order->product_id = $spec->product_id;

        // 如果传入车辆的车主与传入的客户信息有出入， 删除车辆信息
        $car = Car::find($order->car_id);
        if(!$car || $car->member_id != $order->member_id) {
            $order->car_id = 0;
        }
    }

    public function deleting(Order $order)
    {
        if($order->status == 1) {
            return $this->response->errorForbidden('订单已审核通过， 禁止删除！');
        }
    }
}