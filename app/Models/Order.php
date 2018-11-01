<?php

namespace App\Models;

class Order extends Model
{
    protected $fillable = ['member_id', 'car_id', 'money', 'dealt_at', 'status', 'remark', 'number'];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function hubs()
    {
        return $this->hasManyThrough(Hub::class, OrderProduct::class);
    }

    public function getParametersAttribute($value)
    {
        if(!$value) {
            return '';
        }

        if (!is_array($value)) {
            $value = json_decode($value, true);
        }

        return implode('，', $value);
    }

    public function getDiscountAttribute($value)
    {
        if($value == 0) {
            return '无';
        }
        return $value * 100 . '%';
    }

    public function getIdnumber()
    {
        return $this->employee_id . date('md') . rand(111, 999) . uniqid();
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
