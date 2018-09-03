<?php

namespace App\Models;

class Store extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'employees_count', 'is_open'];
}
