<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/13
 * Time: 15:13
 */

namespace App\Transformers;

use App\Models\Car;
use App\Models\Commission;
use League\Fractal\TransformerAbstract;

class CommissionTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['order', 'employee', 'subordinate'];

    public function transform(Car $car)
    {
        return [
            'id' => $car->id,
            'type' => $car->brand,
            'order_id' => $car->vehicles,
            'subordinate_id' => $car->specs,
            'money' => (string) $car->production_date,
        ];
    }

    public function includeOrder(Commission $commission)
    {
        return $this->item($commission->order, new OrderTransformer());
    }

    public function includeEmployee(Commission $commission)
    {
        return $this->item($commission->employee, new EmployeeTransformer());
    }

    public function includeSubordinate(Commission $commission)
    {
        return $this->item($commission->subordinate, new EmployeeTransformer());
    }
}