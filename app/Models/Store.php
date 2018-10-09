<?php

namespace App\Models;

class Store extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'is_open', 'remark'];

    /**
     * 根据销售的订单数量计算佣金提成百分比
     * @param $order_count 订单数量
     * @return float
     */
    public function getSaleRate($order_count) {
        $sale_rates = json_decode($this->sale_rate, true);
        $sale_rate = 0.1;
        foreach($sale_rates as $rate) {
            $min_res = !isset($rate['min']) || $rate['min'] == 0 ? true : $order_count >= $rate['min'];
            $max_res = !isset($rate['max']) || $rate['max'] == 0 ? true : $order_count <= $rate['max'];
            if($min_res && $max_res) {
                $sale_rate = $rate['rate'];
            }
        }

        return $sale_rate;
    }

    public function hasEmployee()
    {
        return !empty($this->employees());
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Employee::class);
    }

    public function stockOrders()
    {
        return $this->hasMany(StockOrder::class);
    }
}
