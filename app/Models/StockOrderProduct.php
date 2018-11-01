<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOrderProduct extends Model
{

    protected $fillable = ['spec_id', 'product_id', 'car_vehicle_id', 'color', 'number', 'remark'];

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    public function hubs()
    {
        return $this->hasMany(Hub::class);
    }
    public function carVehicle()
    {
        return $this->belongsTo(CarVehicle::class);
    }

}
