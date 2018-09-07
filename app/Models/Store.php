<?php

namespace App\Models;

class Store extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'is_open', 'remark'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
