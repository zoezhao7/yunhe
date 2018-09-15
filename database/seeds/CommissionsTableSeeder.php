<?php

use Illuminate\Database\Seeder;
use App\Models\Commission;

class CommissionsTableSeeder extends Seeder
{
    public function run()
    {
        $commissions = factory(Commission::class)->times(50)->make()->each(function ($commission, $index) {
            if ($index == 0) {
                // $commission->field = 'value';
            }
        });

        Commission::insert($commissions->toArray());
    }

}

