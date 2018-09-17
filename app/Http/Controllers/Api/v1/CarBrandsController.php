<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandsController extends Controller
{
    public function index()
    {
        $carBrands = CarBrand::all();

        $brands = [];
        foreach ($carBrands as $brand)
        {
            if($brand->is_hot == 1) {
                $brands['hots'][] = [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'image' => $brand->image,
                ];
            }

            $brands['letters'][$brand->letter][] = [
                'id' => $brand->id,
                'name' => $brand->name,
                'image' => $brand->image,
            ];
        }

        return $this->response->array($brands);
    }

    public function vehicleIndex(Request $request, CarBrand $brand)
    {
        $brand = CarBrand::find($request->brand_id);
        $vehicles = $brand->carVehicles()->get()->toArray();
        return $this->response->array(['data' => $vehicles]);
    }

}
