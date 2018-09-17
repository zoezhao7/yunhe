<?php

namespace App\Models;

class CarBrand extends Model
{
    protected $table = 'car_brands';

    protected $fillable = ['name'];

    public function carVehicles()
    {
        return $this->hasMany(CarVehicle::class);
    }
}
