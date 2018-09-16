<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/13
 * Time: 15:13
 */

namespace App\Transformers;

use App\Models\Commission;
use League\Fractal\TransformerAbstract;

class CommissionTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['order', 'employee', 'subordinate'];

    public function transform(Commission $commission)
    {
        return [
            'id' => $commission->id,
            'type' => $commission->type,
            'order_id' => $commission->order_id,
            'subordinate_id' => $commission->subordinate_id,
            'money' => $commission->money,
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
        if($commission->subordinate_id) {
            return $this->item($commission->subordinate, new EmployeeTransformer());
        }
    }
}