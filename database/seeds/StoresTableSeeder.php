<?php

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoresTableSeeder extends Seeder
{
    public function run()
    {
        $stores = factory(Store::class)->times(50)->make()->each(function ($store, $index) {
            if ($index == 0) {
                // $store->field = 'value';
            }
        });

        Store::insert($stores->toArray());
    }

}

