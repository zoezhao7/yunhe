<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Assert;

class CommissionRule extends Model
{
    protected $fillable = ['sale_rate', 'subordinate_rate', 'remark'];

    protected function getSaleRateAttribute($value)
    {
        if(Assert::isJson($value)) {
            return json_decode($value, true);
        }
        return $value;
    }

    /**
     * 根据销售的订单数量计算佣金提成百分比
     * @param $order_count 订单数量
     * @return float
     */
    public function getSaleRate($order_count) {
        $sale_rate = 0.1;
        foreach($this->sale_rate as $rate) {
            $min_res = !isset($rate['min']) || $rate['min'] == 0 ? true : $order_count >= $rate['min'];
            $max_res = !isset($rate['max']) || $rate['max'] == 0 ? true : $order_count <= $rate['max'];
            if($min_res && $max_res) {
                $sale_rate = $rate['rate'];
            }
        }

        return $sale_rate;
    }
}
