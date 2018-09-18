<?php

namespace App\Models;

class Car extends Model
{
    protected $fillable = ['member_id', 'brand', 'vehicles', 'specs', 'color', 'production_date', 'buy_date', 'image', 'plate_number'];

    /**
     * 判断车辆归属的客户，是否属于登录用户
     * @return bool
     */
    public function belongsToAuthorizer()
    {
        if(!empty($this->member)) {
            return $this->member->employee_id === \Auth::guard('api')->user()->id;
        }
        return true;
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
