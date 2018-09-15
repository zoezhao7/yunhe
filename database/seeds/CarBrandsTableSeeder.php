<?php

use Illuminate\Database\Seeder;
use App\Models\CarBrand;

class CarBrandsTableSeeder extends Seeder
{
    public function run()
    {
        $car_brands = factory(CarBrand::class)->times(50)->make()->each(function ($car_brand, $index) {
            if ($index == 0) {
                // $car_brand->field = 'value';
            }
        });

        $brands = [
            ['name' => '奔驰'],
            ['name' => '宝马'],
            ['name' => '保时捷'],
            ['name' => '捷豹'],
            ['name' => '法拉利'],
            ['name' => '英菲尼迪'],
            ['name' => '凯迪拉克'],
            ['name' => '玛莎拉蒂'],
            ['name' => '沃尔沃'],
            ['name' => '奥迪'],
        ];

        CarBrand::insert($brands);
    }

}

