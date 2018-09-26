<?php

namespace App\Observers;

use App\Models\Car;
use App\Models\Order;
use App\Models\Spec;
use App\Notifications\OrderChecked;
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

        //签单销售的id
        $order->employee_id = \Auth::guard('api')->user()->id;

        // 如果传入车辆的车主与传入的客户信息有出入， 删除车辆信息
        $car = Car::find($order->car_id);
        if(!$car || $car->member_id != $order->member_id) {
            $order->car_id = 0;
        }

        $order->idnumber = $order->getIdnumber();
    }

    public function updated(Order $order)
    {
        if($order->employee_id !== \Auth::guard('store')->user()->id) {
            return $this->response->errorForbidden('不是你的订单， 禁止操作！');
        }

        // 订单状态变动时添加消息
        if($order->isDirty('status')) {
            $employee = $order->member->employee;
            $employee->notify(new OrderChecked($order));
            $employee->increment('notification_count');

            // 操作客户积分
            if($order->status == 1) {
                $order->member->gainCoinsByOrder($order);
            }
        }
    }

    public function deleting(Order $order)
    {
        if($order->employee_id !== \Auth::guard('api')->user()->id) {
            return $this->response->errorForbidden('不是你的订单， 禁止删除！');
        }

        if($order->status > 0) {
            return $this->response->errorForbidden('订单已审核， 禁止删除！');
        }
    }
}