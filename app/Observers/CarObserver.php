<?php

namespace App\Observers;

use App\Models\Car;
use App\Models\Order;
use Dingo\Api\Routing\Helpers;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CarObserver
{
    use Helpers;

    public function creating(Car $car)
    {
        //
    }

    public function updating(Car $car)
    {
        //
    }

    public function deleting(Car $car)
    {
        if ($car->member->employee_id !== \Auth::guard('api')->user()->id)
        {
            return $this->response->errorForbidden('车辆主人不是您的客户，禁止删除！');
        }

        if (Order::where('car_id', $car->id)->first() )
        {
            return $this->response->errorForbidden('车辆已绑定订单，禁止删除！');
        }
    }

    public function deleted(Car $car)
    {
    }
}