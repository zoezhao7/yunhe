<?php

use Illuminate\Database\Seeder;
use App\Models\Memo;

class MemosTableSeeder extends Seeder
{
    public function run()
    {
        $memos = factory(Memo::class)->times(50)->make()->each(function ($memo, $index) {
            if ($index == 0) {
                // $memo->field = 'value';
            }
        });

        Memo::insert($memos->toArray());
    }

}

