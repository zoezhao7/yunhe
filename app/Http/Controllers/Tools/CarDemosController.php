<?php

namespace App\Http\Controllers\Tools;

use App\Models\CarDemo;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarDemosController extends Controller
{
    public function index()
    {
        return view('tools.car_demos.index');
    }

    public function cars()
    {
        $data = CarDemo::all();
        foreach ($data as $key => $value) {
            $data[$key]->more = json_decode($value->more, true);
        }
        return response(['data' => $data]);
    }

    public function hubs()
    {
        $data = Product::select(['id', 'image'])
            ->where('is_sale', 1)
            ->where('image', '<>', '')
            ->get();
        return response(['data' => $data]);
    }
}
