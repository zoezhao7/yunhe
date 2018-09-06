<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorysTableSeeder extends Seeder
{
    public function run()
    {
        $categorys = [
            [
                'name' => 'U系列',
                'description' => '',
            ],
            [
                'name' => 'S系列',
                'description' => '',
            ],
            [
                'name' => 'C系列',
                'description' => '',
            ],
        ];

        Category::insert($categorys);
    }

}

