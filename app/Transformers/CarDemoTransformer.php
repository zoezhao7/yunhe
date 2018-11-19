<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/13
 * Time: 15:13
 */

namespace App\Transformers;

use App\Models\CarDemo;
use League\Fractal\TransformerAbstract;

class CarDemoTransformer extends TransformerAbstract
{

    public function transform(CarDemo $carDemo)
    {
        return [
            'id' => $carDemo->id,
            'name' => $carDemo->name,
            'image' => $carDemo->image,
            'more' => json_decode($carDemo->more),
        ];
    }

}