<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/13
 * Time: 15:13
 */

namespace App\Transformers;

use App\Models\Car;
use League\Fractal\TransformerAbstract;

class CarTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['member'];

    public function transform(Car $car)
    {
        return [
            'id' => $car->id,
            'brand' => $car->brand,
            'vehicles' => $car->vehicles,
            'specs' => $car->specs,
            'production_date' => (string) $car->production_date,
            'buy_date' => (string) $car->buy_date,
            'color' => $car->color,
            'remark' => $car->remark,
            'plate_number' => $car->plate_number,
        ];
    }

    public function includeMember(Car $car)
    {
        return $this->item($car->member());
    }
}