<?php

namespace App\Models;

class Member extends Model
{
    protected $fillable = ['name', 'phone', 'idnumber', 'address', 'status'];

    /**
     * 客户是否属于登录当前登录用户
     * @return bool
     */
    public function belongsToAuthorizer()
    {
        return $this->employee_id === \Auth::guard('api')->user()->id;
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
}
