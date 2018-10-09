<?php

use Illuminate\Database\Seeder;
use App\Models\Spec;
use App\Models\Product;
use Faker\Generator as Faker;

class SpecsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker::class);
        $product_ids = Product::recent()->limit(10)->pluck('id');
        $sizes = ['19*8.0', '19*8.5', '19*9', '20*8.5', '20*9.0', '20*10', '20*11', '21*9.5', '21*10', '21*11.5'];
        $contents = [
            ['工艺'=>'半哑光黑', 'ET'=>'33', 'CB'=>'66.5', 'PCD'=>'5*112', 'CAP'=>'奥迪小盖','PCD钻头'=>'15*32*SR13','螺丝'=>'M12*1.5'],
            ['工艺'=>'半哑光黑', 'ET'=>'71', 'CB'=>'71.6', 'PCD'=>'5*130', 'CAP'=>'捷豹盖','PCD钻头'=>'15*32*60','螺丝'=>'M12*1.5'],
            ['工艺'=>'金属拉丝', 'ET'=>'69', 'CB'=>'60.1', 'PCD'=>'5*114.3', 'CAP'=>'宝马盖','PCD钻头'=>'m14*1.5','螺丝'=>'M14*1.5'],
            ['工艺'=>'半哑光黑', 'ET'=>'38', 'CB'=>'67.1', 'PCD'=>'5*108', 'CAP'=>'宝马盖','PCD钻头'=>'m12*1.5','螺丝'=>'M14*1.5'],
            ['工艺'=>'金属拉丝', 'ET'=>'45', 'CB'=>'70.6', 'PCD'=>'5*120', 'CAP'=>'','PCD钻头'=>'15*32*SR13','螺丝'=>''],
            ['工艺'=>'半哑光黑', 'ET'=>'50', 'CB'=>'66.5', 'PCD'=>'5*108', 'CAP'=>'','PCD钻头'=>'','螺丝'=>''],
            ['工艺'=>'金属拉丝', 'ET'=>'35', 'CB'=>'63.4', 'PCD'=>'5*112', 'CAP'=>'','PCD钻头'=>'','螺丝'=>''],
        ];

        $specs = factory(Spec::class)
            ->times(100)
            ->make()
            ->each(function ($spec, $index) use ($faker, $product_ids, $sizes, $contents) {
                $spec->product_id = $faker->randomElement($product_ids);
                $spec->idnumber = 'UC' . rand(111111, 999999);
                $spec->content = json_encode($faker->randomElement($contents));
                $spec->size = $faker->randomElement($sizes);
                $spec->price = rand(1111, 9999);
            });

        Spec::insert($specs->toArray());
    }

}

