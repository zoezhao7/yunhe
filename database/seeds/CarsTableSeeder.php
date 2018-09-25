<?php

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Member;
use Faker\Generator as Faker;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        $member_ids = Member::all()->pluck('id');
        $faker = app(Faker::class);

        $buy_date = $faker->Date('Y-m-d');
        $production_date = $faker->Date('Y-m-d', $buy_date);

        $car_arr = [
            ['brand_id' => '168', 'vehicles' => 'X9', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand_id' => '182', 'vehicles' => 'Q5', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand_id' => '185', 'vehicles' => 'S系', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand_id' => '169', 'vehicles' => 'X7', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand_id' => '185', 'vehicles' => 'S8', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand_id' => '169', 'vehicles' => 'F系列', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand_id' => '168', 'vehicles' => 'M3', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
        ];


        $cars = factory(Car::class)
            ->times(50)
            ->make()
            ->each(function ($car, $index) use ($faker, $member_ids, $car_arr) {
                $car->member_id = $faker->randomElement($member_ids);

                $car_cur = $faker->randomElement($car_arr);
                $car->brand_id = $car_cur['brand_id'];
                $car->vehicles = $car_cur['vehicles'];
                $car->specs = $car_cur['specs'];
                $car->production_date = $car_cur['production_date'];
                $car->buy_date = $car_cur['buy_date'];
            });

        Car::insert($cars->toArray());
    }

}

