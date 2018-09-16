<?php

namespace App\Models;
use App\Http\Requests\AuthorizationRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $tokenSalt = 'yhyunhe#_lsf';

    protected $fillable = ['name', 'phone', 'store_id', 'type', 'password', 'idnumber', 'api_token', 'superior_id'];

    public static $types = [
        ['id' => 2, 'name' => '销售'],
        ['id' => 3, 'name' => '渠道'],
        ['id' => 1, 'name' => '店长'],
    ];

    // 下级
    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'superior_id', 'id');
    }

    // 上级
    public function superior()
    {
        return $this->belongsTo(Employee::class, id, 'superior_id');
    }

    // 订单
    public function orders()
    {
        return $this->hasManyThrough(Order::class, Member::class);
    }

    // 下级订单
    public function subordinateOrders()
    {
        return $this->hasManyThrough();
    }

    // 佣金
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getToken()
    {
        return md5(md5($this->id . '|' . $this->tokenSalt . '|' . time()));
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function hasMember()
    {
        return !empty($this->members());
    }


    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }


}
