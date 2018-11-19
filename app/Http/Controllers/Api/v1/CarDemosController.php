<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\CarDemo;
use App\Models\Product;
use App\Transformers\CarDemoTransformer;
use App\Transformers\CarDemoHubTransformer;

class CarDemosController extends Controller
{
    public function cars()
    {
        $carDemos = CarDemo::query()->get();

        return $this->response->collection($carDemos, new CarDemoTransformer());
    }

    public function hubs()
    {
        $hubs = Product::query()
            ->where('is_sale', 1)
            ->where('image', '<>', '')
            ->get();

        return $this->response->collection($hubs, new CarDemoHubTransformer());
    }
}
