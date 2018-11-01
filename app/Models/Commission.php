<?php

namespace App\Models;

class Commission extends Model
{
    protected $fillable = ['employee_id', 'type', 'suboardinate_id', 'order_id', 'money'];


    /**
     * 计算佣金
     * @param $month
     * @param Employee $employee
     */
    public static function calculate($month, Employee $employee)
    {
        $start = $month . '-01';
        $end = date( 'Y-m-01', (strtotime('+1 month', strtotime($start))) );

        $orders = $employee->orders()
            ->where('dealt_at', '>=', $start)
            ->where('dealt_at', '<=', $end)
            ->where('orders.status', 1)
            ->get();

        $order_count = count($orders);

        $commissionRule = CommissionRule::first();
        $sale_rate = $commissionRule->getSaleRate($order_count);
        $subordinate_rate = $commissionRule->subordinate_rate;

        //删除已存在的佣金记录
        Commission::where('month', $month)->delete();

        // 订单佣金
        foreach($orders as $order) {
            $commission = [
                'month' => $month,
                'employee_id' => $employee->id,
                'type' => 'order',
                'order_id' => $order->id,
                'money' => $order->money * $sale_rate,
                'created_at' => now(),
            ];
            Commission::insert($commission);
        }

        // 下线提成
        $subordinate_ids = $employee->subordinates()->pluck('id');
        $subordinate_orders = \DB::table('orders')
            ->selectRaw('orders.*, employees.id as employee_id')
            ->leftJoin('members', 'orders.member_id', '=', 'members.id')
            ->leftJoin('employees', 'members.employee_id', '=', 'employees.id')
            ->where('orders.status', 1)
            ->whereIn('employees.id', $subordinate_ids)
            ->get();

        foreach($subordinate_orders as $order)
        {
            $commission = [
                'month' => $month,
                'employee_id' => $employee->id,
                'type' => 'subordinate',
                'subordinate_id' => $order->employee_id,
                'order_id' => $order->id,
                'money' => $order->money * $subordinate_rate,
                'created_at' => now(),
            ];
            Commission::insert($commission);
        }
        
    }

    // 员工
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // 订单
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 下线
    public function subordinate()
    {
        return $this->belongsTo(Employee::class, 'subordinate_id', 'id');
    }
}
