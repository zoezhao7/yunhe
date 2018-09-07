<?php

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        $cars = factory(Car::class)->times(50)->make()->each(function ($car, $index) {
            if ($index == 0) {
                // $car->field = 'value';
            }
        });

        Car::insert($cars->toArray());
    }

}

