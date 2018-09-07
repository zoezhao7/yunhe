<?php

namespace App\Models;

class Order extends Model
{
    protected $fillable = ['member_id', 'car_id', 'spec_id', 'parameters', 'price', 'discount', 'money', 'dealt_at', 'status'];
}
