<?php

namespace App\Models;

use App\Http\Requests\AuthorizationRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $tokenSalt = 'yhyunhe#_lsf';

    protected $fillable = ['name', 'phone', 'store_id', 'type', 'password', 'idnumber', 'api_token', 'superior_id', 'status'];

    public static $statusMsg = [
        '1' => ['id' => 1, 'name' => '在职', 'label_class' => 'label-success'],
        '2' => ['id' => 2, 'name' => '离职', 'label_class' => 'label-danger'],
        '3' => ['id' => 3, 'name' => '兼职', 'label_class' => 'label-warning'],
    ];

    public static $typeMsg = [
        '2' => ['id' => 2, 'name' => '销售', 'label_class' => 'label-success'],
        '3' => ['id' => 3, 'name' => '渠道', 'label_class' => 'label-warning'],
        '4' => ['id' => 4, 'name' => '客服', 'label_class' => 'label-primary'],
        '5' => ['id' => 5, 'name' => '技术', 'label_class' => 'label-info'],
        '1' => ['id' => 1, 'name' => '店长', 'label_class' => 'label-danger'],
    ];

    // 下级
    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'superior_id', 'id');
    }

    // 上级
    public function superior()
    {
        return $this->belongsTo(Employee::class, 'superior_id', 'id');
    }

    // 订单
    public function orders()
    {
        return $this->hasManyThrough(Order::class, Member::class);
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

    public function memos()
    {
        return $this->hasMany(Memo::class);
    }

    public function hasMember()
    {
        return $this->members()->count() > 0;
    }


    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function getStatusStringAttribute()
    {
        return $this->statusMsg[$this->status]['label_string'];
    }

    public function getAvatarAttribute($value)
    {
        return $value ? $value : $this->defaultAvatar();
    }

    public function isSuperAdmin()
    {
        return false;
    }

    public function defaultAvatar()
    {
        return config('app.url') . '/member/images/avatar_pic.jpg';
    }

    public function getStarStringAttribute()
    {
        $str = '';
        for ($i = 0; $i < $this->star; $i++) {
            $str .= '<span class="on"></span>';
        }
        for ($i = 0; $i < (5 - $this->star); $i++) {
            $str .= '<span></span>';
        }
        return $str;
    }

    public function membersCount()
    {
        return $this->members()->count() + 20;
    }
}
