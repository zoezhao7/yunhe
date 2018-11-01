<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarVehicle extends Model
{

    public static function getArrayTree()
    {
        $brands_res = CarBrand::select('id', 'name')->get()->toArray();
        $brands = [];
        foreach ($brands_res as $brand) {
            $brands[$brand['id']]['brand'] = $brand;
        }
        $vehicles = CarVehicle::select('id', 'car_brand_id', 'name')->get()->toArray();

        foreach ($vehicles as $vehicle) {
            if (!isset($brands[$vehicle['car_brand_id']])) {
                continue;
            }
            $brands[$vehicle['car_brand_id']]['vehicles'][] = $vehicle;
        }

        return $brands;

    }

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class);
    }

}
