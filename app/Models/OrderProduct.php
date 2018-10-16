<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['order_id', 'spec_id', 'color', 'number'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    public function hubs()
    {
        return $this->hasMany(Hub::class);
    }
}
