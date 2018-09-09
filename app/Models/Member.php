<?php

namespace App\Models;

class Member extends Model
{
    protected $fillable = ['name', 'phone', 'employee_id', 'store_id', 'idnumber', 'address', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
