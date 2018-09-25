<?php

namespace App\Models;

class Member extends Model
{
    protected $fillable = ['name', 'phone', 'idnumber', 'address', 'status', 'remark'];

    /**
     * 客户是否属于登录当前登录用户
     * @return bool
     */
    public function belongsToAuthorizer()
    {
        return $this->employee_id === \Auth::guard('api')->user()->id;
    }

    /**
     * 增加订单积分
     * @param Order $order
     */
    public function gainCoinsByOrder(Order $order)
    {
        $coin_count = $this->coin_count + ceil($order->money);
        $this->coin_count = $coin_count;
        $this->save();

        $data = [
            'member_id' => $this->id,
            'order_id' => $order->id,
            'type' => '1',
            'number' => ceil($order->money),
            'account_number' => $coin_count,
            'remark' => '购买 - 订单编号[' . $order->idnumber . ']',
        ];
        Coin::insert($data);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function memos()
    {
        return $this->hasMany(Memo::class);
    }
}
