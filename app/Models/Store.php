<?php

namespace App\Models;

class Store extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'is_open', 'remark'];

    public function hasEmployee()
    {
        return !empty($this->employees());
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Employee::class);
    }

    public function stockOrders()
    {
        return $this->hasMany(StockOrder::class);
    }
}
