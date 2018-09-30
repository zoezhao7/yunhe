<?php

namespace App\Models;

class Coin extends Model
{
    protected $fillable = ['member_id', 'employee_id', 'order_id', 'type', 'number', 'account_number', 'remark'];

    public static $typeMsg = [
        1 => ['id' => 1, 'name' => '购买轮毂', 'label_class' => 'label-info'],
        2 => ['id' => 2, 'name' => '人工操作',  'label_class' => 'label-warning'],
    ];

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
