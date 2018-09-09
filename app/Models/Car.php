<?php

namespace App\Models;

class Car extends Model
{
    protected $fillable = ['member_id', 'brand', 'vehicles', 'specs', 'color', 'production_date', 'buy_date', 'image'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
