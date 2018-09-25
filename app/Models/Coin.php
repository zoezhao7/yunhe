<?php

namespace App\Models;

class Coin extends Model
{
    protected $fillable = ['member_id', 'employee_id', 'order_id', 'type', 'number', 'account_number', 'remark'];

    protected $type_info = ['1' => '订单', '2' => '人工操作'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * 操作员
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
