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
            ['brand' => '大众', 'vehicles' => '捷达', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand' => '奥迪', 'vehicles' => 'Q5', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand' => '奔驰', 'vehicles' => 'S系', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand' => '捷豹', 'vehicles' => 'X7', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand' => '凯迪拉克', 'vehicles' => 'S8', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand' => '玛莎拉蒂', 'vehicles' => 'F系列', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
            ['brand' => '英菲尼迪', 'vehicles' => 'M3', 'specs' => '高配', 'production_date' => $production_date, 'buy_date' => $buy_date],
        ];


        $cars = factory(Car::class)
            ->times(50)
            ->make()
            ->each(function ($car, $index) use ($faker, $member_ids, $car_arr) {
                $car->member_id = $faker->randomElement($member_ids);

                $car_cur = $faker->randomElement($car_arr);
                $car->brand = $car_cur['brand'];
                $car->vehicles = $car_cur['vehicles'];
                $car->specs = $car_cur['specs'];
                $car->production_date = $car_cur['production_date'];
                $car->buy_date = $car_cur['buy_date'];
            });

        Car::insert($cars->toArray());
    }

}

