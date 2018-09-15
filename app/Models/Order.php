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
}
