<?php

namespace App\Models;

class Spec extends Model
{
    protected $fillable = ['number', 'product_id', 'price', 'discount', 'content'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stockOrders()
    {
        return $this->hasMany(StockOrder::class);
    }

    public function hasOrder()
    {
        return $this->orders()->count() > 0 || $this->stockOrders()->count() > 0;
    }

    protected function getContentAttribute($value)
    {
        if(is_array($value)) {
            return $value;
        }

        return json_decode($value, true);
    }

}
