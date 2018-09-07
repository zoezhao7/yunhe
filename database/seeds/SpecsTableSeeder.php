<?php

use Illuminate\Database\Seeder;
use App\Models\Spec;

class SpecsTableSeeder extends Seeder
{
    public function run()
    {
        $specs = factory(Spec::class)->times(50)->make()->each(function ($spec, $index) {
            if ($index == 0) {
                // $spec->field = 'value';
            }
        });

        Spec::insert($specs->toArray());
    }

}

