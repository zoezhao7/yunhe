<?php

use Illuminate\Database\Seeder;
use App\Models\Coin;

class CoinsTableSeeder extends Seeder
{
    public function run()
    {
        $coins = factory(Coin::class)->times(50)->make()->each(function ($coin, $index) {
            if ($index == 0) {
                // $coin->field = 'value';
            }
        });

        Coin::insert($coins->toArray());
    }

}

