<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Member extends UserModel
{
    use Notifiable;

    protected $fillable = ['name', 'phone', 'idnumber', 'address', 'status', 'remark', 'employee_id', 'avatar', 'weixin_openid', 'weixin_unionid'];

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
        $coin = ceil($order->money * Coin::$orderPercent);
        $coin_count = $this->coin_count + $coin;
        $this->coin_count = $coin_count;
        $this->save();

        $data = [
            'member_id' => $this->id,
            'order_id' => $order->id,
            'type' => '1',
            'number' => $coin,
            'account_number' => $coin_count,
            'remark' => '购买轮毂 - 订单编号[' . $order->idnumber . ']',
        ];
        $coin = Coin::create($data);
        return $coin;
    }

    // 客户名下有待审核和审核通过的订单
    public function hasOrder()
    {
        return $this->orders()->whereIn('status', [0,1])->count() > 0;
    }

    public function coins()
    {
        return $this->hasMany(Coin::class);
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

    public function isSuperAdmin()
    {
        return false;
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
