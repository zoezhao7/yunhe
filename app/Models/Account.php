<?php

namespace App\Models;

class Account extends Model
{
    protected $fillable = ['store_id', 'employee_id', 'order_id', 'stock_order_id', 'type', 'money', 'channel', 'operated_at', 'remark'];

    public $typeMsg = [
        1 => ['id' => 1, 'name' => '收入', 'label_class' => 'label-success'],
        2 => ['id' => 2, 'name' => '支出', 'label_class' => 'label-danger'],
    ];

    public $channelMsg = [
        1 => ['id' => '销售', 'name' => '销售'],
        2 => ['id' => '备货', 'name' => '备货'],
        3 => ['id' => '行政采购', 'name' => '行政采购'],
        4 => ['id' => '其它', 'name' => '其它'],
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function stockOrder()
    {
        return $this->belongsTo(StockOrder::class);
    }
}
