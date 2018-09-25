<?php

namespace App\Models;

class Order extends Model
{
    protected $fillable = ['member_id', 'car_id', 'product_id', 'spec_id', 'parameters', 'price', 'discount', 'money', 'dealt_at', 'status', 'remark', 'number'];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getParametersAttribute($value)
    {
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
        return $this->spec->number . rand(1111, 9999) . time();
    }
}
