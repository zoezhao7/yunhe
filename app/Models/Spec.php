<?php

namespace App\Models;

class Spec extends Model
{
    protected $fillable = ['idnumber', 'product_id', 'price', 'discount', 'content', 'size'];

    public static $paramMsg = [
        ['name' => '工艺', 'placeholder' => '半哑光黑'],
        ['name' => 'ET', 'placeholder' => '33'],
        ['name' => 'CB', 'placeholder' => '66.5'],
        ['name' => 'PCD', 'placeholder' => '5*112'],
        ['name' => 'CAP', 'placeholder' => '奥迪小盖'],
        ['name' => 'PCD钻头', 'placeholder' => '15*32*SR13'],
        ['name' => '螺丝', 'placeholder' => 'M12*1.5'],
    ];

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

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
