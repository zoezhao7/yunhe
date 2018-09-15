<?php

namespace App\Models;

class Commission extends Model
{
    protected $fillable = ['employee_id', 'type', 'suboardinate_id', 'order_id', 'money'];

    public function calculate($month, Employee $employee)
    {
        $start = $month . '-1 00:00:00';
        $end = date('Y-m-01 00:00:00', strtotime($start, '-1 month'));

        $orders = $employee->orders()
            ->whereRaw('dealt_at >= ' . $start)
            ->whereRaw('dealt_at <= ' . $end)
            ->where('status', 1)
            ->get();

        $order_count = count($orders);
        
    }

    // 员工
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // 订单
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    // 下线
    public function suboardinate()
    {
        return $this->hasOne(Employee::class, 'id', 'suboardinate_id');
    }
}
