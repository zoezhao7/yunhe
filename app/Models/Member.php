<?php

namespace App\Models;

class Member extends Model
{
    protected $fillable = ['name', 'phone', 'employee_id', 'store_id', 'idnumber', 'address', 'status'];
}
